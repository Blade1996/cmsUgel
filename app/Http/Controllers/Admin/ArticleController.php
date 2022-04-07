<?php

namespace App\Http\Controllers\Admin;

use Auth;
use File;
use Image;
use Session;
use DateTime;
use App\Article;
use App\Company;
use App\Section;
use DateTimeZone;
use App\DocumentTree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index()
    {
        Session::put('page', 'articles');
        $articles = Article::orderBy('creado', 'desc')->where('idarticulo_categoria', '<>', 10)->get(['id', 'titulo', 'estado']);
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.articles.articles')->with(compact('articles', 'companyData'));
    }

    public function updateArticleStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Activado') {
                $status = 0;
            } else {
                $status = 1;
            }
            Article::where('id', $data['id'])->update(['estado' => $status]);
            return response()->json(['status' => $status, 'id' => $data['id']]);
        }
    }


    public function addArticle(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();
            /* echo '<pre>';
            print_r($data);
            die;*/

            $article = new Article;

            if (!File::exists('images/backend_images/articles')) {
                $path = 'images/admin_images/articles';
                File::makeDirectory($path, 0755, true, true);
            }

            // Upload Image
            if ($request->hasFile('articleImage')) {
                $image_tmp = $request->file('articleImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/articles/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $article->imagen = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }

            if ($request->hasFile('articleFile')) {
                $article->archivo = $this->loadFile($request, 'articleFile', 'article/files', 'articles');
            }

            if ($request->hasFile('sliderImage')) {
                $article->imagen_slider = $this->loadFile($request, 'sliderImage', 'sliders', 'sliders');
            }


            if (!empty($data['showCaption'])) {
                $article->show_caption = 1;
            }

            $article->titulo = $data['articleTitle'];
            $article->idarticulo_categoria = $data['categoryId'];
            $article->idusuario = Auth::guard('admin')->user()->id;
            $article->resumen = $data['articleResume'] ?? '';
            $article->tipo = $data['typelink'] ?? '';
            $article->redireccion = $data['articleTextLink'] ?? '';
            $article->video = $data['articleUrlVideo'] ?? '';
            $article->tree_id = $data['treeId'];
            $article->creado = new DateTime('now', new DateTimeZone('America/Lima'));
            $article->modificado = new DateTime('now', new DateTimeZone('America/Lima'));
            $article->descripcion = htmlspecialchars_decode(e($data['articleContent']));

            $article->save();
            Session::flash('success_message', 'El articulo se creo Correctamente');
            return redirect()->route('dashboard.articles.index');
        }

        $categories = DB::table('dx_articulo_categoria')->select('id', 'titulo')->where('id', '<>', 10)->get();
        $trees = DocumentTree::where('parent_id', '=', 0)->pluck('name', 'id')->all();
        $companyData = getCompanyData();
        return view('admin.articles.add_article')->with(compact('categories', 'companyData', 'trees'));
    }

    public function editArticle(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {

            $data = $request->all();
            /*            echo '<pre>';
            print_r($data);
            die;*/

            $article = Article::find($id);

            // Upload Image
            if ($request->hasFile('articleImage')) {
                $articleImage = $this->loadFile($request, 'articleImage', 'article/files', 'articles');
            } else if (!empty($data['currentArticleImage'])) {
                $articleImage = $data['currentArticleImage'];
            } else {
                $articleImage = '';
            }

            if ($request->hasFile('articleFile')) {
                $article->archivo = $this->loadFile($request, 'articleFile', 'article/files', 'articles');
            } else {
                $article->archivo = $data['currentArticleFile'] ?? "";
            }

            /* if ($request->hasFile('sliderImage')) {
                $article->imagen_slider = $this->loadFile($request, 'sliderImage', 'sliders', 'sliders');
            } else if (!empty($data['currentSliderImage'])) {
                $article->imagen_slider = $data['currentSliderImage'];
            } else {
                $article->imagen_slider = '';
            }*/

            if (!empty($data['treeId'])) {
                $article->tree_id = $data['treeId'];
            }

            if (!empty($data['showCaption'])) {
                $article->show_caption = 1;
            } else {
                $article->show_caption = 0;
            }

            $article->titulo = $data['articleTitle'];
            $article->idarticulo_categoria = $data['categoryId'];
            $article->imagen = $articleImage;
            $article->idusuario = Auth::guard('admin')->user()->id;
            $article->resumen = $data['articleResume'] ?? '';
            $article->tipo = $data['typelink'] ?? '';
            $article->redireccion = $data['articleTextLink'] ?? '';
            $article->video = $data['articleUrlVideo'];
            $article->modificado = new DateTime('now', new DateTimeZone('America/Lima'));
            $article->descripcion = htmlspecialchars_decode(e($data['articleContent']));

            $article->update();

            Session::flash('success_message', 'El articulo se Actualizo Correctamente');
            return redirect()->route('dashboard.articles.index');
        }

        $articleDetail = Article::find($id);
        $categories = DB::table('dx_articulo_categoria')->select('id', 'titulo')->where('id', '<>', 10)->get();
        $trees = DocumentTree::where('parent_id', '=', 0)->pluck('name', 'id')->all();
        $tree_drop_down = "<option value='' selected disabled>Selected</option>";
        foreach ($trees as $id => $tree) {
            if ($id == $articleDetail->tree_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $tree_drop_down .= "<option value='" . $id . "' " . $selected . ">" . $tree . "</option>";
        }
        $categories_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $category) {
            if ($category->id == $articleDetail->idarticulo_categoria) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $categories_drop_down .= "<option value='" . $category->id . "' " . $selected . ">" . $category->titulo . "</option>";
        }
        $companyData = getCompanyData();
        return view('admin.articles.edit_article')->with(compact('categories_drop_down', 'articleDetail', 'companyData', 'tree_drop_down'));
    }

    public function destroy($id)
    {
        Article::find($id)->delete();
        $message = 'La Seccion se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.articles.index');
    }
}
