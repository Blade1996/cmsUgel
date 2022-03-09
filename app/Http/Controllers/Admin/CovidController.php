<?php

namespace App\Http\Controllers\Admin;


use Image;
use App\Covid;
use App\Section;
use App\Auxiliar;
use App\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CovidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'covid');
        $covids = Covid::get();
        $companyData = getCompanyData();
        return view('admin.covid.covid')->with(compact('covids', 'companyData'));
    }

    public function updateCovidStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Activado') {
                $status = 0;
            } else {
                $status = 1;
            }
            Covid::where('id', $data['id'])->update(['estado' => $status]);
            return response()->json(['status' => $status, 'id' => $data['id']]);
        }
    }

    public function add(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $covid = new Covid();

            if ($request->hasFile('covidFile')) {
                $covid->archivo = $this->loadFile($request, 'covidFile', 'covid/files', 'covid');
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $covid->nombre = $data['covidTitle'];
            $covid->idcovid_categoria = $data['categoryId'];
            $covid->fecha = $date_now;
            $covid->estado = 1;

            $covid->save();

            Session::flash('success_message', 'El anuncio se creo Correctamente');
            return redirect()->route('dashboard.covid.index');
        }
        $categories = DB::table('dx_covid_categoria')->select('id', 'titulo')->where('estado', 1)->get();
        $companyData = getCompanyData();
        return view('admin.covid.add_covid')->with(compact('categories', 'companyData'));
    }

    public function edit(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {

            $covid = Covid::find($id);

            $data = $request->all();
            // echo '<pre>'; print_r($data); die;

            if ($request->hasFile('covidFile')) {
                $covid->archivo = $this->loadFile($request,  'covidFile', 'covid/files', 'covid');
            } else {
                $covid->archivo = $data['currentCovidFile'] ?? "";
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $covid->nombre = $data['covidTitle'];
            $covid->idcovid_categoria = $data['categoryId'];

            $covid->update();

            Session::flash('success_message', 'La Convocatoria se Actualizo Correctamente');
            return redirect()->route('dashboard.covid.index');
        }

        $covidDetail = Covid::where(['id' => $id])->first();

        $categories = DB::table('dx_covid_categoria')->select('id', 'titulo')->where('estado', 1)->get();
        $categories_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $category) {
            if ($category->id == $covidDetail->idcovid_categoria) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $categories_drop_down .= "<option value='" . $category->id . "' " . $selected . ">" . $category->titulo . "</option>";
        }
        $companyData = getCompanyData();
        return view('admin.covid.edit_covid')->with(compact('categories_drop_down', 'covidDetail', 'companyData'));
    }

    public function destroy($id)
    {
        Covid::find($id)->delete();
        $message = 'El Articulo covid se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.covid.index');
    }
}
