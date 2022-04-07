<?php

namespace App\Http\Controllers\Admin;

use Auth;
use File;
use DateTime;
use App\Article;
use DateTimeZone;
use App\DocumentTree;
use App\InterestLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class InterestLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'links');
        $links = Article::where('idarticulo_categoria', 10)->get();
        $companyData = getCompanyData();
        return view('admin.interestLink.interestLink', compact('links', 'companyData'));
    }

    public function updateLinkStatus(Request $request)
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

    public function add(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();
            /*   echo '<pre>';
            print_r($data);
            die; */

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

            $article->titulo = $data['articleTitle'];
            $article->idarticulo_categoria = 10;
            $article->idusuario = Auth::guard('admin')->user()->id;
            $article->resumen = $data['articleResume'];
            $article->tipo = $data['typelink'] ?? '';
            $article->tree_id = $data['treeId'];
            $article->redireccion = $data['articleTextLink'] ?? '';
            $article->video = $data['articleUrlVideo'] ?? '';
            $article->creado = new DateTime('now', new DateTimeZone('America/Lima'));
            $article->modificado = new DateTime('now', new DateTimeZone('America/Lima'));
            $article->descripcion = htmlspecialchars_decode(e($data['articleContent']));

            $article->save();
            Session::flash('success_message', 'El articulo se creo Correctamente');
            return redirect()->route('dashboard.link.index');
        }

        $trees = DocumentTree::where('parent_id', '=', 0)->pluck('name', 'id')->all();
        $categories = DB::table('dx_articulo_categoria')->select('id', 'titulo')->get();
        $companyData = getCompanyData();
        return view('admin.interestLink.add_interestLink')->with(compact('categories', 'companyData', 'trees'));
    }

    public function edit(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {

            $data = $request->all();
            /*  echo '<pre>';
            print_r($data);
            die; */
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

            if (!empty($data['treeId'])) {
                $article->tree_id = $data['treeId'];
            }

            $article->titulo = $data['articleTitle'];
            $article->idarticulo_categoria = 10;
            $article->imagen = $articleImage;
            $article->idusuario = Auth::guard('admin')->user()->id;
            $article->resumen = $data['articleResume'];
            $article->tipo = $data['typelink'] ?? '';
            $article->redireccion = $data['articleTextLink'] ?? '';
            $article->video = $data['articleUrlVideo'] ?? '';
            $article->modificado = new DateTime('now', new DateTimeZone('America/Lima'));
            $article->descripcion = htmlspecialchars_decode(e($data['articleContent']));

            $article->update();

            Session::flash('success_message', 'El articulo se Actualizo Correctamente');
            return redirect()->route('dashboard.link.index');
        }

        $trees = DocumentTree::where('parent_id', '=', 0)->pluck('name', 'id')->all();
        $linkDetail = Article::where(['id' => $id])->first();
        $tree_drop_down = "<option value='' selected disabled>Selected</option>";
        foreach ($trees as $id => $tree) {
            if ($id == $linkDetail->tree_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $tree_drop_down .= "<option value='" . $id . "' " . $selected . ">" . $tree . "</option>";
        }
        /*         $categories = DB::table('dx_articulo_categoria')->select('id', 'titulo')->get();
        $categories_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $category) {
            if ($category->id == $linkDetail->idarticulo_categoria) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $categories_drop_down .= "<option value='" . $category->id . "' " . $selected . ">" . $category->titulo . "</option>";
        } */
        $companyData = getCompanyData();
        return view('admin.interestLink.edit_interestLink')->with(compact('linkDetail', 'companyData', 'tree_drop_down'));
    }

    public function destroy($id)
    {
        Article::find($id)->delete();
        $message = 'El Articulo covid se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.link.index');
    }
}
