<?php

namespace App\Http\Controllers\Admin;

use App\Section;
use App\Announcements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class AnnouncementController extends Controller
{

    private $mediaCollection = 'files';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'announcement');
        $announcements = Announcements::get();
        $companyData = getCompanyData();
        return view('admin.announcements.announcements')->with(compact('announcements', 'companyData'));
    }

    public function updateAnnouncementStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Activado') {
                $status = 0;
            } else {
                $status = 1;
            }
            Announcements::where('id', $data['id'])->update(['estado' => $status]);
            return response()->json(['status' => $status, 'id' => $data['id']]);
        }
    }

    public function indexAnnouncementsHome()
    {
        $announcements = Announcements::where('category_id', 2)->get();
        $sections = Section::where([['id', '<>', 5], ['id', '<>', 6], ['id', '<>', 7]])->get();
        $mediaCollection = $this->mediaCollection;
        $companyData = getCompanyData();
        return view('frontend.announcements')->with(compact('announcements', 'companyData', 'sections', 'mediaCollection'));
    }

    public function add(Request $request, $slug = null)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $document = new Announcements;
            /* echo '<pre>';
            print_r($data);
            die;*/

            $document->nombre = $data['announcementTitle'];
            $document->idconvocatoria_categoria = $data['categoryId'];
            $document->descripcion = $data['announcementDescription'];
            $document->fecha = Carbon::now('America/lima');
            $document->save();

            foreach ($request->input('file', []) as $file) {
                $document->addMedia(public_path('tmp/uploads/announcements/' . $file))->toMediacollection($this->mediaCollection);
            }


            Session::flash('success_message', 'La Convocatoria se creo Correctamente');
            return redirect()->route('dashboard.announcement.index');
        }
        $categories = DB::table('dx_convocatoria_categoria')->select('id', 'titulo')->where('estado', 1)->get();
        $companyData = getCompanyData();
        return view('admin.announcements.add_announcement')->with(compact('categories', 'companyData', 'slug'));
    }

    public function edit(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {

            $document = Announcements::with('files')->find($id);

            $data = $request->all();
            // echo '<pre>'; print_r($data); die;
            $document->nombre = $data['announcementTitle'];
            $document->idconvocatoria_categoria = $data['categoryId'];
            $document->descripcion = $data['announcementDescription'];
            $document->fecha = Carbon::now('America/lima');
            $document->update();

            if (count($document->files) > 0) {
                foreach ($document->files as $media) {
                    if (!in_array($media->file_name, $request->input('files', []))) {
                        $media->delete();
                    }
                }
            }

            $media = $document->files->pluck('file_name')->toArray();

            foreach ($request->input('files', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $document->addMedia(public_path('tmp/uploads/announcements/' . $file))->toMediaCollection($this->mediaCollection);
                }
            }

            Session::flash('success_message', 'La Convocatoria se Actualizo Correctamente');
            return redirect()->route('dashboard.announcement.index');
        }

        $announcementDetail = Announcements::where(['id' => $id])->first();
        $categories = DB::table('dx_convocatoria_categoria')->select('id', 'titulo')->where('estado', 1)->get();
        $categories_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $category) {
            if ($category->id == $announcementDetail->idconvocatoria_categoria) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $categories_drop_down .= "<option value='" . $category->id . "' " . $selected . ">" . $category->titulo . "</option>";
        }
        $companyData = getCompanyData();
        $files = $announcementDetail->getMedia($this->mediaCollection);
        return view('admin.announcements.edit_announcement')->with(compact('categories_drop_down', 'announcementDetail', 'companyData', 'files'));
    }

    public function storeMedia(Request $request)
    {
        $path = public_path('tmp/uploads/announcements/');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }


    public function regulations()
    {
        Session::put('page', 'regulations');
        $title = 'Normativas';
        $slug = 'normativas';
        $documents = Announcements::where('category_id', 3)->get();
        $companyData = getCompanyData();
        return view('admin.documents.documents')->with(compact('documents', 'companyData', 'title', 'slug'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Announcements::find($id)->delete();
        $message = 'El documento se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.documents.index');
    }
}
