<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Reassign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class ReassignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'reassign');
        $reassigns = Reassign::get();
        $companyData = getCompanyData();
        return view('admin.reassign.reassign', compact('reassigns', 'companyData'));
    }

    public function add(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $reassign = new Reassign();

            if ($request->hasFile('reassignFile')) {
                $reassign->archivo = $this->loadFile($request, 'reassignFile', 'reassign/files', 'reassigns');
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $reassign->nombre = $data['reassignTitle'];
            $reassign->idreasi_categoria = $data['categoryId'];
            $reassign->fecha = $date_now;
            $reassign->estado = 1;

            $reassign->save();

            Session::flash('success_message', 'El anuncio se creo Correctamente');
            return redirect()->route('dashboard.reassign.index');
        }
        $categories = DB::table('dx_reasi_categoria')->select('id', 'titulo')->where('estado', 1)->get();
        $companyData = getCompanyData();
        return view('admin.reassign.add_reassign')->with(compact('categories', 'companyData'));
    }

    public function edit(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {

            $reassign = Reassign::find($id);

            $data = $request->all();
            // echo '<pre>'; print_r($data); die;

            if ($request->hasFile('reassignFile')) {
                $reassign->archivo = $this->loadFile($request, 'reassignFile', 'reassign/files', 'reassigns');
            } else {
                $reassign->archivo = $data['currentReassignFile'] ?? "";
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $reassign->nombre = $data['reassignTitle'];
            $reassign->idreasi_categoria = $data['categoryId'];

            $reassign->update();

            Session::flash('success_message', 'La Convocatoria se Actualizo Correctamente');
            return redirect()->route('dashboard.reassign.index');
        }

        $reassignDetail = Reassign::where(['id' => $id])->first();

        $categories = DB::table('dx_reasi_categoria')->select('id', 'titulo')->get();
        $categories_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $category) {
            if ($category->id == $reassignDetail->idreasi_categoria) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $categories_drop_down .= "<option value='" . $category->id . "' " . $selected . ">" . $category->titulo . "</option>";
        }
        $companyData = getCompanyData();
        return view('admin.reassign.edit_reassign')->with(compact('categories_drop_down', 'reassignDetail', 'companyData'));
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
