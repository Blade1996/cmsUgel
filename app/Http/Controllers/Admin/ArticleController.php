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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index()
    {
        Session::put('page', 'articles');
        $articles = Article::orderBy('creado', 'desc')->get();
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.articles.articles')->with(compact('articles', 'companyData'));
    }

    public function addArticle(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

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

            $article->titulo = $data['articleTitle'];
            $article->idarticulo_categoria = $data['categoryId'];
            $article->idusuario = Auth::guard('admin')->user()->id;
            $article->resumen = $data['articleResume'];
            $article->video = $data['articleUrlVideo'] ?? '';
            $article->creado = new DateTime('now', new DateTimeZone('America/Lima'));
            $article->descripcion = htmlspecialchars_decode(e($data['articleContent']));

            $article->save();
            Session::flash('success_message', 'El articulo se creo Correctamente');
            return redirect()->route('dashboard.articles.index');
        }

        $categories = DB::table('dx_articulo_categoria')->select('id', 'titulo')->get();
        $companyData = getCompanyData();
        return view('admin.articles.add_article')->with(compact('categories', 'companyData'));
    }

    public function editArticle(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {

            $data = $request->all();
            /*     echo '<pre>';
            print_r($data);
            die; */


            $article = new Article;

            // Upload Image
            if ($request->hasFile('articleImage')) {
                $articleImage = $this->loadFile($request, 'articleImage', 'article/files', 'articles');
            } else if (!empty($data['currentArticleImage'])) {
                $articleImage = $data['currentArticleImage'];
            } else {
                $articleImage = '';
            }

            $article->titulo = $data['articleTitle'];
            $article->section_id = $data['categoryId'];
            $article->imagen = $articleImage;
            $article->idusuario = Auth::guard('admin')->user()->id;
            $article->resumen = $data['articleResume'];
            $article->video = $data['articleUrlVideo'] ?? '';
            $article->creado = new DateTime('now', new DateTimeZone('America/Lima'));
            $article->descripcion = htmlspecialchars_decode(e($data['articleContent']));

            $article->update();

            Session::flash('success_message', 'El articulo se Actualizo Correctamente');
            return redirect()->route('dashboard.articles.index');
        }

        $articleDetail = Article::where(['id' => $id])->first();

        $categories = DB::table('dx_articulo_categoria')->select('id', 'titulo')->get();
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
        return view('admin.articles.edit_article')->with(compact('categories_drop_down', 'articleDetail', 'companyData'));
    }

    public function deleteArticle($id)
    {
        Article::find($id)->delete();
        $message = 'La Seccion se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.articles.index');
    }
}
