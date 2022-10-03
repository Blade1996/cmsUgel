<?php

namespace App\Http\Controllers\Admin;

use App\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'election');
        $elections = Election::get();
        $companyData = getCompanyData();
        return view('admin.election.election', compact('elections', 'companyData'));
    }

    public function updateElectionStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Activado') {
                $status = 0;
            } else {
                $status = 1;
            }
            Election::where('id', $data['id'])->update(['estado' => $status]);
            return response()->json(['status' => $status, 'id' => $data['id']]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $election = new Election();

            if ($request->hasFile('electionFile')) {
                $election->archivo = $this->loadFile($request, 'electionFile', 'election/files', 'elections');
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $election->nombre = $data['electionTitle'];
            $election->ideleccion_categoria = $data['categoryId'];
            $election->fecha = $date_now;
            $election->estado = 1;

            $election->save();

            Session::flash('success_message', 'El anuncio se creo Correctamente');
            return redirect()->route('dashboard.election.index');
        }
        $categories = DB::table('dx_eleccion_categoria')->select('id', 'titulo')->where('estado', 1)->get();
        $companyData = getCompanyData();
        return view('admin.election.add_election')->with(compact('categories', 'companyData'));
    }

    public function edit(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {

            $election = Election::find($id);

            $data = $request->all();
            // echo '<pre>'; print_r($data); die;

            if ($request->hasFile('electionFile')) {
                $election->archivo = $this->loadFile($request, 'electionFile', 'election/files', 'elections');
            } else {
                $election->archivo = $data['currentElectionFile'] ?? "";
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $election->nombre = $data['electionTitle'];
            $election->ideleccion_categoria = $data['categoryId'];

            $election->fecha = $date_now;
            $election->update();

            Session::flash('success_message', 'La Convocatoria se Actualizo Correctamente');
            return redirect()->route('dashboard.election.index');
        }

        $electionDetail = Election::where(['id' => $id])->first();

        $categories = DB::table('dx_eleccion_categoria')->select('id', 'titulo')->get();
        $categories_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $category) {
            if ($category->id == $electionDetail->ideleccion_categoria) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $categories_drop_down .= "<option value='" . $category->id . "' " . $selected . ">" . $category->titulo . "</option>";
        }
        $companyData = getCompanyData();
        return view('admin.election.edit_election')->with(compact('categories_drop_down', 'electionDetail', 'companyData'));
    }

    public function destroy($id)
    {
        Election::find($id)->delete();
        $message = 'El Articulo covid se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.election.index');
    }
}
