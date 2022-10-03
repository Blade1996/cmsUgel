<?php

namespace App\Http\Controllers\Admin;

use App\Rotate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class RotateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'rotate');
        $rotates = Rotate::get();
        $companyData = getCompanyData();
        return view('admin.rotate.rotate', compact('rotates', 'companyData'));
    }

    public function updateRotateStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Activado') {
                $status = 0;
            } else {
                $status = 1;
            }
            Rotate::where('id', $data['id'])->update(['estado' => $status]);
            return response()->json(['status' => $status, 'id' => $data['id']]);
        }
    }

    public function add(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $rotate = new Rotate();

            if ($request->hasFile('rotate')) {
                $rotate->archivo = $this->loadFile($request, 'contractFile', 'rotate/files', 'rotates');
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $rotate->nombre = $data['contractTitle'];
            $rotate->idrotacion_categoria = $data['categoryId'];
            $rotate->fecha = $date_now;
            $rotate->estado = 1;

            $rotate->save();

            Session::flash('success_message', 'El anuncio se creo Correctamente');
            return redirect()->route('dashboard.rotate.index');
        }
        $categories = DB::table('dx_rotacion_categoria')->select('id', 'titulo')->where('estado', 1)->get();
        $companyData = getCompanyData();
        return view('admin.rotate.add_rotate')->with(compact('categories', 'companyData'));
    }

    public function edit(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {

            $rotate = Rotate::find($id);

            $data = $request->all();
            // echo '<pre>'; print_r($data); die;

            if ($request->hasFile('rotateFile')) {
                $rotate->archivo = $this->loadFile($request, 'contractFile', 'rotate/files', 'rotates');
            } else {
                $rotate->archivo = $data['currentRotateFile'] ?? "";
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $rotate->nombre = $data['rotateTitle'];
            $rotate->idrotacion_categoria = $data['categoryId'];
            $rotate->fecha = $date_now;

            $rotate->update();

            Session::flash('success_message', 'La Convocatoria se Actualizo Correctamente');
            return redirect()->route('dashboard.rotate.index');
        }

        $rotateDetail = Rotate::where(['id' => $id])->first();

        $categories = DB::table('dx_rotacion_categoria')->select('id', 'titulo')->get();
        $categories_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $category) {
            if ($category->id == $rotateDetail->idrotacion_categoria) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $categories_drop_down .= "<option value='" . $category->id . "' " . $selected . ">" . $category->titulo . "</option>";
        }
        $companyData = getCompanyData();
        return view('admin.rotate.edit_rotate')->with(compact('categories_drop_down', 'rotateDetail', 'companyData'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
