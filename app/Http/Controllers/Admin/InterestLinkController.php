<?php

namespace App\Http\Controllers\Admin;

use Auth;
use File;
use DateTime;
use Image;
use DateTimeZone;
use App\DocumentTree;
use App\InterestLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
        $links = InterestLink::orderBy('creado', 'desc')->get(['id', 'titulo', 'estado']);
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
            InterestLink::where('id', $data['id'])->update(['estado' => $status]);
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

            $link = new InterestLink;

            if (!File::exists('images/backend_images/links')) {
                $path = 'images/admin_images/links';
                File::makeDirectory($path, 0755, true, true);
            }

            // Upload Image
            if ($request->hasFile('linkImage')) {
                $image_tmp = $request->file('linkImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/links/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $link->imagen = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }

            if ($request->hasFile('linkFile')) {
                $link->archivo = $this->loadFile($request, 'linkFile', 'link/files', 'links');
            }

            $link->titulo = $data['linkTitle'];
            $link->idservicio_categoria = $data['categoryId'];
            $link->idusuario = Auth::guard('admin')->user()->id;
            $link->resumen = $data['linkResume'];
            $link->tipo = $data['typelink'] ?? '';
            $link->tree_id = $data['treeId'];
            $link->redireccion = $data['linkTextLink'] ?? '';
            $link->video = $data['linkUrlVideo'] ?? '';
            $link->creado = Carbon::now('America/Lima');
            $link->modificado = Carbon::now('America/Lima');
            $link->descripcion = htmlspecialchars_decode(e($data['linkContent']));

            $link->save();
            Session::flash('success_message', 'El articulo se creo Correctamente');
            return redirect()->route('dashboard.link.index');
        }

        $trees = DocumentTree::where('parent_id', '=', 0)->pluck('name', 'id')->all();
        $categories = DB::table('dx_servicio_categoria')->select('id', 'descripcion')->get();
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
            $link = InterestLink::find($id);

            // Upload Image
            if ($request->hasFile('linkImage')) {
                $linkImage = $this->loadFile($request, 'linkImage', 'link/files', 'links');
            } else if (!empty($data['currentLinkImage'])) {
                $linkImage = $data['currentLinkImage'];
            } else {
                $linkImage = '';
            }

            if ($request->hasFile('linkFile')) {
                $link->archivo = $this->loadFile($request, 'linkFile', 'link/files', 'links');
            } else {
                $link->archivo = $data['currentLinkFile'] ?? "";
            }

            if (!empty($data['treeId'])) {
                $link->tree_id = $data['treeId'];
            }

            $link->titulo = $data['linkTitle'];
            $link->idservicio_categoria = $data['categoryId'];
            $link->imagen = $linkImage;
            $link->idusuario = Auth::guard('admin')->user()->id;
            $link->resumen = $data['linkResume'];
            $link->tipo = $data['typelink'] ?? '';
            $link->redireccion = $data['linkTextLink'] ?? '';
            $link->video = $data['linkUrlVideo'] ?? '';
            $link->modificado = now('America/Lima');
            $link->descripcion = htmlspecialchars_decode(e($data['linkContent']));

            $link->update();

            Session::flash('success_message', 'El articulo se Actualizo Correctamente');
            return redirect()->route('dashboard.link.index');
        }

        $trees = DocumentTree::where('parent_id', '=', 0)->pluck('name', 'id')->all();
        $linkDetail = InterestLink::where(['id' => $id])->first();
        $tree_drop_down = "<option value='' selected disabled>Selected</option>";
        foreach ($trees as $id => $tree) {
            if ($id == $linkDetail->tree_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $tree_drop_down .= "<option value='" . $id . "' " . $selected . ">" . $tree . "</option>";
        }
        $categories = DB::table('dx_servicio_categoria')->select('id', 'descripcion')->get();
        $categories_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $category) {
            if ($category->id == $linkDetail->idservicio_categoria) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $categories_drop_down .= "<option value='" . $category->id . "' " . $selected . ">" . $category->descripcion . "</option>";
        }
        $companyData = getCompanyData();
        return view('admin.interestLink.edit_interestLink')->with(compact('linkDetail', 'companyData', 'tree_drop_down', 'categories_drop_down'));
    }

    public function destroy($id)
    {
        InterestLink::find($id)->delete();
        $message = 'El Articulo covid se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.link.index');
    }
}
