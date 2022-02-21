<?php

namespace App\Http\Controllers\Admin;

use App\Unit;
use App\Company;
use App\Control;
use App\Question;
use Illuminate\Http\Request;
use App\Scopes\ActivatedScope;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class ControlController extends Controller
{

    public function index()
    {
        Session::put('page', 'control');
        $controls = Control::get();
        $companyData = getCompanyData();
        return view('admin.control.control', compact('controls', 'companyData'));
    }


    public function add(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $control = new Control();

            if ($request->hasFile('controlFile')) {
                $control->archivo = $this->loadFile($request, 'controlFile', 'control/files', 'controls');
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $control->nombre = $data['controlTitle'];
            $control->idcontrol_categoria = $data['categoryId'];
            $control->fecha = $date_now;
            $control->estado = 1;

            $control->save();

            Session::flash('success_message', 'El anuncio se creo Correctamente');
            return redirect()->route('dashboard.control .index');
        }
        $categories = DB::table('dx_control_categoria')->select('id', 'titulo')->where('estado', 1)->get();
        $companyData = getCompanyData();
        return view('admin.control.add_control')->with(compact('categories', 'companyData'));
    }

    public function edit(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {

            $control = Control::find($id);

            $data = $request->all();
            // echo '<pre>'; print_r($data); die;

            if ($request->hasFile('controlFile')) {
                $control->archivo = $this->loadFile($request, 'controlFile', 'control/files', 'controls');
            } else {
                $control->archivo = $data['currentControlFile'] ?? "";
            }

            $control->nombre = $data['controlTitle'];
            $control->idcontrol_categoria = $data['categoryId'];

            $control->update();

            Session::flash('success_message', 'La Convocatoria se Actualizo Correctamente');
            return redirect()->route('dashboard.control.index');
        }

        $controlDetail = Control::where(['id' => $id])->first();

        $categories = DB::table('dx_control_categoria')->select('id', 'titulo')->where('estado', 1)->get();
        $categories_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $category) {
            if ($category->id == $controlDetail->idcontrol_categoria) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $categories_drop_down .= "<option value='" . $category->id . "' " . $selected . ">" . $category->titulo . "</option>";
        }
        $companyData = getCompanyData();
        return view('admin.control.edit_control')->with(compact('categories_drop_down', 'controlDetail', 'companyData'));
    }

    public function destroy($id)
    {
        Question::withoutGlobalScope(ActivatedScope::class)->findOrFail($id)->delete();
        return redirect()->route('questions.index')->with('status', '¡Eliminado satisfactoriamente!');
    }

    public function changeStatus($id)
    {
        $question = Question::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        if ($question->is_activated == 0) {
            $question->is_activated = 1;
        } else {
            $question->is_activated = 0;
        }
        $question->save();
        return $question;
    }
}
