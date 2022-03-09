<?php

namespace App\Http\Controllers\Admin;

use App\Advertisements;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdvertisementsController extends Controller
{

    private $mediaCollection = 'files';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'advertisements');
        $advertisements = Advertisements::get();
        $companyData = getCompanyData();
        return view('admin.advertisements.advertisements')->with(compact('advertisements', 'companyData'));
    }

    public function updateAdvertisementStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Activado') {
                $status = 0;
            } else {
                $status = 1;
            }
            Advertisements::where('id', $data['id'])->update(['estado' => $status]);
            return response()->json(['status' => $status, 'id' => $data['id']]);
        }
    }

    public function add(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $advertisement = new Advertisements();

            if ($request->hasFile('advertisementFile3')) {

                $advertisement->archivo1 = $this->loadFile($request, 'advertisementFile1', 'advertisement/files', 'advertisements');
            }

            if ($request->hasFile('advertisementFile2')) {

                $advertisement->archivo2 = $this->loadFile($request, 'advertisementFile2', 'advertisement/files', 'advertisements');
            }

            if ($request->hasFile('advertisementFile3')) {
                $advertisement->archivo3 = $this->loadFile($request, 'advertisementFile3', 'advertisement/files', 'advertisements');
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $advertisement->titulo = $data['advertisementTitle'];
            $advertisement->descripcion = $data['advertisementDescription'];
            $advertisement->titulo1 = $data['advertisementTitle1'] ?? "";
            $advertisement->titulo2 = $data['advertisementTitle2'] ?? "";
            $advertisement->titulo3 = $data['advertisementTitle3'] ?? "";
            $advertisement->creado = $date_now;
            $advertisement->modificado = $date_now;
            $advertisement->estado = 1;

            $advertisement->save();

            Session::flash('success_message', 'El anuncio se creo Correctamente');
            return redirect()->route('dashboard.advertisements.index');
        }
        $companyData = getCompanyData();
        return view('admin.advertisements.add_advertisement')->with(compact('companyData'));
    }

    public function edit(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {

            $advertisement = Advertisements::find($id);

            $data = $request->all();
            // echo '<pre>'; print_r($data); die;


            if ($request->hasFile('advertisementFile1')) {
                $advertisement->archivo1 = $this->loadFile($request, 'advertisementFile1', 'advertisement/files', 'advertisements');
            } else {
                $advertisement->archivo1 = $data['currentAdvertisementFile1'] ?? "";
            }

            if ($request->hasFile('advertisementFile2')) {
                $advertisement->archivo2 = $this->loadFile($request, 'advertisementFile2', 'advertisement/files', 'advertisements');
            } else {
                $advertisement->archivo2 = $data['currentAdvertisementFile2'] ?? "";
            }

            if ($request->hasFile('advertisementFile3')) {
                $advertisement->archivo3 = $this->loadFile($request, 'advertisementFile3', 'advertisement/files', 'advertisements');
            } else {
                $advertisement->archivo3 = $data['currentAdvertisementFile3'] ?? "";
            }

            $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));

            $advertisement->titulo = $data['advertisementTitle'];
            $advertisement->descripcion = $data['advertisementDescription'];
            $advertisement->titulo1 = $data['advertisementTitle1'] ?? "";
            $advertisement->titulo2 = $data['advertisementTitle2'] ?? "";
            $advertisement->titulo3 = $data['advertisementTitle3'] ?? "";
            $advertisement->creado = $date_now;
            $advertisement->modificado = $date_now;
            $advertisement->estado = 1;

            $advertisement->update();

            /*     $advertisement->update(['titulo1' => $data['announcementTitle'], 'description' => $data['announcementDescription'], 'idconvocatoria_categoria x' => $data['sectionId']]);
 */
            Session::flash('success_message', 'La Convocatoria se Actualizo Correctamente');
            return redirect()->route('dashboard.advertisements.index');
        }
        $advertisementDetail = Advertisements::where(['id' => $id])->first();
        /*        $sections = Section::get();
        $section_drop_down = "<option value='' disabled>Select</option>";
        foreach ($sections as $section) {
            if ($section->id == $announcementDetail->section_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $section_drop_down .= "<option value='" . $section->id . "' " . $selected . ">" . $section->name . "</option>";
        }
 */
        $companyData = getCompanyData();
        return view('admin.advertisements.edit_advertisement')->with(compact('advertisementDetail', 'companyData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Advertisements::find($id)->delete();
        $message = 'El Anuncio se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.advertisements.index');
    }
}
