<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Advertising;
use App\DocumentTree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class AdvertisingController extends Controller
{
    public function index()
    {
        Session::put('page', 'advertising');
        $advertisings = Advertising::get();
        $companyData = getCompanyData();
        return view('admin.advertising.advertising')->with(compact('advertisings', 'companyData'));
    }

    public function updateAdvertisingStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Activado') {
                $status = 0;
            } else {
                $status = 1;
            }
            Advertising::where('id', $data['id'])->update(['estado' => $status]);
            return response()->json(['status' => $status, 'id' => $data['id']]);
        }
    }



    public function add(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $advertising = new Advertising();

            if ($request->hasFile('advertisingImage')) {
                $advertising->image = $this->loadFile($request, 'advertisingImage', 'advertising/files', 'advertisings');
            }

            if ($request->hasFile('advertisingFile')) {
                $advertising->archivo = $this->loadFile($request, 'advertisingFile', 'advertising/files', 'advertisings');
            }
            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $advertising->titulo = $data['advertisingTitle'];
            $advertising->idpublicidad_categoria = $data['categoryId'];
            $advertising->url = $data['advertisingRedirect'];
            $advertising->tree_id = $data['treeId'];
            $advertising->tipo = $data['typelink'] ?? '';
            $advertising->creado = $date_now;
            $advertising->modificado = $date_now;
            $advertising->estado = 1;

            $advertising->save();

            Session::flash('success_message', 'El anuncio se creo Correctamente');
            return redirect()->route('dashboard.advertisements.index');
        }
        $categories = DB::table('dx_publicidad_categoria')->select('id', 'descripcion')->where('estado', 1)->get();
        $trees = DocumentTree::where('parent_id', '=', 0)->pluck('name', 'id')->all();
        $companyData = getCompanyData();
        return view('admin.advertising.add_advertising')->with(compact('categories', 'companyData', 'trees'));
    }

    public function edit(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {

            $advertising = Advertising::find($id);

            $data = $request->all();
            // echo '<pre>'; print_r($data); die;

            if ($request->hasFile('advertisingImage')) {
                $advertising->image = $this->loadFile($request, 'advertisingImage', 'advertising/files', 'advertisings');
            } else {
                $advertising->image = $data['currentAdvertisingImage'] ?? "";
            }

            if ($request->hasFile('advertisingFile')) {
                $advertising->archivo = $this->loadFile($request, 'advertisingFile', 'advertising/files', 'advertisings');
            } else {
                $advertising->archivo = $data['currentAdvertisingFile'] ?? "";
            }

            if (!empty($data['treeId'])) {
                $advertising->tree_id = $data['treeId'];
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $advertising->titulo = $data['advertisingTitle'];
            $advertising->idpublicidad_categoria = $data['categoryId'];
            $advertising->url = $data['advertisingRedirect'] ?? "";
            $advertising->tipo = $data['typelink'] ?? '';
            $advertising->fecha = $date_now;

            $advertising->update();

            Session::flash('success_message', 'La Convocatoria se Actualizo Correctamente');
            return redirect()->route('dashboard.advertising.index');
        }

        $advertisingDetail = Advertising::find($id);
        $trees = DocumentTree::where('parent_id', '=', 0)->pluck('name', 'id')->all();
        $categories = DB::table('dx_publicidad_categoria')->select('id', 'descripcion')->where('estado', 1)->get();
        $categories_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $category) {
            if ($category->id == $advertisingDetail->idpublicidad_categoria) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $categories_drop_down .= "<option value='" . $category->id . "' " . $selected . ">" . $category->descripcion . "</option>";
        }
        $tree_drop_down = "<option value='' selected disabled>Selected</option>";
        foreach ($trees as $id => $tree) {
            if ($id == $advertisingDetail->tree_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $tree_drop_down .= "<option value='" . $id . "' " . $selected . ">" . $tree . "</option>";
        }
        $companyData = getCompanyData();
        return view('admin.advertising.edit_advertising')->with(compact('categories_drop_down', 'advertisingDetail', 'companyData', 'tree_drop_down'));
    }

    public function storeMedia(Request $request)
    {
        $path = public_path('tmp/uploads/advertising/');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }


    public function destroy($id)
    {
        Advertising::find($id)->delete();
        $message = 'La Publicidad se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.advertising.edit');
    }
}
