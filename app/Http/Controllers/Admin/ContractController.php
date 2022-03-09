<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Contract;
use App\TypeAnswer;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ContractController extends Controllers\Controller
{

    public function index()
    {
        Session::put('page', 'contract');
        $contracts = Contract::get();
        $companyData = getCompanyData();
        return view('admin.contract.contract', compact('contracts', 'companyData'));
    }

    public function updateContractStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Activado') {
                $status = 0;
            } else {
                $status = 1;
            }
            Contract::where('id', $data['id'])->update(['estado' => $status]);
            return response()->json(['status' => $status, 'id' => $data['id']]);
        }
    }

    public function add(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $contract = new Contract();

            if ($request->hasFile('contractFile')) {
                $contract->archivo = $this->loadFile($request, 'contractFile', 'contract/files', 'contracts');
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $contract->nombre = $data['contractTitle'];
            $contract->idauxi_categoria = $data['categoryId'];
            $contract->fecha = $date_now;
            $contract->estado = 1;

            $contract->save();

            Session::flash('success_message', 'El anuncio se creo Correctamente');
            return redirect()->route('dashboard.contract.index');
        }
        $categories = DB::table('dx_contrato_categoria')->select('id', 'titulo')->where('estado', 1)->get();
        $companyData = getCompanyData();
        return view('admin.contract.add_contract')->with(compact('categories', 'companyData'));
    }

    public function edit(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {

            $contract = Contract::find($id);

            $data = $request->all();
            // echo '<pre>'; print_r($data); die;

            if ($request->hasFile('contractFile')) {
                $contract->archivo = $this->loadFile($request, 'contractFile', 'contract/files', 'contracts');
            } else {
                $contract->archivo = $data['currentContractFile'] ?? "";
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $contract->nombre = $data['contractTitle'];
            $contract->idcontrato_categoria = $data['categoryId'];

            $contract->update();

            Session::flash('success_message', 'La Convocatoria se Actualizo Correctamente');
            return redirect()->route('dashboard.contract.index');
        }

        $contractDetail = Contract::where(['id' => $id])->first();

        $categories = DB::table('dx_contrato_categoria')->select('id', 'titulo')->get();
        $categories_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $category) {
            if ($category->id == $contractDetail->idcontrato_categoria) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $categories_drop_down .= "<option value='" . $category->id . "' " . $selected . ">" . $category->titulo . "</option>";
        }
        $companyData = getCompanyData();
        return view('admin.contract.edit_contract')->with(compact('categories_drop_down', 'contractDetail', 'companyData'));
    }

    public function destroy($id)
    {
        Contract::find($id)->delete();
        $message = 'El Partner se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.contract.index');
    }
}
