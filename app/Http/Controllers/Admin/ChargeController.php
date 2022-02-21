<?php

namespace App\Http\Controllers\Admin;

use App\Charge;
use App\Http\Controllers\Controller;
use App\Http\Requests\TypeAnswerQuestionRequest;
use App\Question;
use App\Scopes\ActivatedScope;
use App\TypeAnswer;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Image;

class ChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'charge');
        $charges = Charge::get();
        $companyData = getCompanyData();
        return view('admin.charge.charge', compact('charges', 'companyData'));
    }

    public function add(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $charge = new Charge();

            if ($request->hasFile('chargeFile')) {
                $charge->archivo = $this->loadFile($request, 'chargeFile', 'charge/files', 'charges');
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $charge->nombre = $data['chargeTitle'];
            $charge->idencargatura_categoria = $data['categoryId'];
            $charge->fecha = $date_now;
            $charge->estado = 1;

            $charge->save();

            Session::flash('success_message', 'El anuncio se creo Correctamente');
            return redirect()->route('dashboard.charge.index');
        }
        $categories = DB::table('dx_encargatura_categoria')->select('id', 'titulo')->where('estado', 1)->get();
        $companyData = getCompanyData();
        return view('admin.charge.add_charge')->with(compact('categories', 'companyData'));
    }

    public function edit(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {

            $charge = Charge::find($id);

            $data = $request->all();
            // echo '<pre>'; print_r($data); die;

            if ($request->hasFile('chargeFile')) {
                $charge->archivo = $this->loadFile($request, 'chargeFile', 'charge/files', 'charges');
            } else {
                $charge->archivo = $data['currentChargeFile'] ?? "";
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $charge->nombre = $data['chargeTitle'];
            $charge->idencargatura_categoria = $data['categoryId'];

            $charge->update();

            Session::flash('success_message', 'La Convocatoria se Actualizo Correctamente');
            return redirect()->route('dashboard.charge.index');
        }

        $chargeDetail = Charge::where(['id' => $id])->first();

        $categories = DB::table('dx_encargatura_categoria')->select('id', 'titulo')->get();
        $categories_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $category) {
            if ($category->id == $chargeDetail->idencargatura_categoria) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $categories_drop_down .= "<option value='" . $category->id . "' " . $selected . ">" . $category->titulo . "</option>";
        }
        $companyData = getCompanyData();
        return view('admin.charge.edit_charge')->with(compact('categories_drop_down', 'chargeDetail', 'companyData'));
    }

    public function destroy($id)
    {
        try {
            DB::table('type_answers_questions')->where('id', $id)->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Eliminado con exíto'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function changeStatus($id)
    {
        $answer_question = DB::table('type_answers_questions')->where('id', $id)->first();
        $value = 0;
        if ($answer_question->status == 0) {
            $value = 1;
        }
        DB::table('type_answers_questions')->where('id', $id)->update(['status' => $value]);
        return $value;
    }
}
