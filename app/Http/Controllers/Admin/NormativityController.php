<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Normativity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class NormativityController extends Controller
{
    public function index()
    {
        Session::put('page', 'normativity');
        $normativities = Normativity::get();
        $companyData = getCompanyData();
        return view('admin.normativity.normativity')->with(compact('normativities', 'companyData'));
    }

    public function updateNormativityStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Activado') {
                $status = 0;
            } else {
                $status = 1;
            }
            Normativity::where('id', $data['id'])->update(['estado' => $status]);
            return response()->json(['status' => $status, 'id' => $data['id']]);
        }
    }


    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            /* echo '<pre>'; print_r($data['sectionName']); die; */

            $link = new Normativity;

            if ($request->hasFile('normativityFile')) {
                $documentFile = $this->loadFile($request, 'normativityFile', 'normativity/files', 'normativity');
            } else {
                $documentFile = '';
            }

            $link->nombre = $data['normativityTitle'] ?? '';
            $link->descripcion = $data['normativityDescription'] ?? '';
            $link->iddisposicion_categoria = $data['categoryId'] ?? '';
            $link->archivo = $documentFile;
            $link->save();

            $message = 'La normatividad se agrego correctamente';
            Session::flash('success_message', $message);
            return redirect()->route('dashboard.normativity.index');
        }
        $categories = DB::table('dx_disposicion_categoria')->select('id', 'titulo')->where('estado', 1)->get();
        $companyData = getCompanyData();
        return view('admin.normativity.add_normativity', compact('categories', 'companyData'));
    }

    public function edit(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            /*   echo '<pre>';
            print_r($data);
            die; */

            $normativity = Normativity::find($id);

            // Upload Image
            if ($request->hasFile('normativityFile')) {
                $normativity->archivo = $this->loadFile($request, 'normativityFile', 'normativity/files', 'normativity');
            } else {
                $normativity->archivo = $data['currentNormativityFile'] ?? '';
            }

            $normativity->nombre = $data['normativityTitle'] ?? '';
            $normativity->descripcion = $data['normativityDescription'] ?? '';
            $normativity->iddisposicion_categoria = $data['categoryId'] ?? '';

            $normativity->update();

            $message = 'La normatividad se actualizo correctamente';
            Session::flash('success_message', $message);
            return redirect()->route('dashboard.normativity.index');
        }
        $normativityDetail = Normativity::where(['id' => $id])->first();

        $categories = DB::table('dx_disposicion_categoria')->select('id', 'titulo')->where('estado', 1)->get();
        $categories_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $category) {
            if ($category->id == $normativityDetail->iddisposicion_categoria) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $categories_drop_down .= "<option value='" . $category->id . "' " . $selected . ">" . $category->titulo . "</option>";
        }

        $categories = DB::table('dx_disposicion_categoria')->select('id', 'titulo')->where('estado', 1)->get();
        $companyData = getCompanyData();
        return view('admin.normativity.edit_normativity')->with(compact('categories_drop_down', 'normativityDetail', 'companyData'));
    }

    public function destroy($id)
    {
        Normativity::find($id)->delete();
        $message = 'El Link se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.normativity.index');
    }
}
