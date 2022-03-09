<?php

namespace App\Http\Controllers\Admin;

use Image;
use Session;
use App\Unit;
use App\Course;
use App\Company;
use App\Auxiliar;
use App\Question;
use Illuminate\Http\Request;
use App\Scopes\ActivatedScope;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\UnitRequestPost;


class AuxiliarController extends Controller
{

    public function index(Request $request)
    {
        Session::put('page', 'auxiliar');
        $auxiliars = Auxiliar::get();
        $companyData = getCompanyData();
        return view('admin.auxiliar.auxiliar', compact('auxiliars', 'companyData'));
    }

    public function updateAuxiliarStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Activado') {
                $status = 0;
            } else {
                $status = 1;
            }
            Auxiliar::where('id', $data['id'])->update(['estado' => $status]);
            return response()->json(['status' => $status, 'id' => $data['id']]);
        }
    }


    public function add(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $auxiliar = new Auxiliar();

            if ($request->hasFile('auxiliarFile')) {
                $auxiliar->archivo = $this->loadFile($request, 'auxiliarFile', 'auxiliar/files', 'auxiliars');
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $auxiliar->nombre = $data['auxiliarTitle'];
            $auxiliar->idauxi_categoria = $data['categoryId'];
            $auxiliar->fecha = $date_now;
            $auxiliar->estado = 1;

            $auxiliar->save();

            Session::flash('success_message', 'El anuncio se creo Correctamente');
            return redirect()->route('dashboard.auxiliar.index');
        }
        $categories = DB::table('dx_auxi_categoria')->select('id', 'titulo')->where('estado', 1)->get();
        $companyData = getCompanyData();
        return view('admin.auxiliar.add_auxiliar')->with(compact('categories', 'companyData'));
    }

    public function edit(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {

            $auxiliar = Auxiliar::find($id);

            $data = $request->all();
            // echo '<pre>'; print_r($data); die;

            if ($request->hasFile('auxiliarFile')) {
                $auxiliar->archivo = $this->loadFile($request, 'auxiliarFile', 'auxiliar/files', 'auxiliars');
            } else {
                $auxiliar->archivo = $data['currentAuxiliarFile'] ?? "";
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $auxiliar->nombre = $data['auxiliarTitle'];
            $auxiliar->idauxi_categoria = $data['categoryId'];

            $auxiliar->update();

            Session::flash('success_message', 'La Convocatoria se Actualizo Correctamente');
            return redirect()->route('dashboard.auxiliar.index');
        }

        $auxiliarDetail = Auxiliar::where(['id' => $id])->first();

        $categories = DB::table('dx_auxi_categoria')->select('id', 'titulo')->where('estado', 1)->get();
        $categories_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $category) {
            if ($category->id == $auxiliarDetail->idauxi_categoria) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $categories_drop_down .= "<option value='" . $category->id . "' " . $selected . ">" . $category->titulo . "</option>";
        }
        $companyData = getCompanyData();
        return view('admin.auxiliar.edit_auxiliar')->with(compact('categories_drop_down', 'auxiliarDetail', 'companyData'));
    }

    public function destroy($id)
    {
        Auxiliar::find($id)->delete();
        $message = 'El Partner se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.auxiliar.index');
    }
}
