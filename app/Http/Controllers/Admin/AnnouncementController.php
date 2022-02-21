<?php

namespace App\Http\Controllers\Admin;

use App\Section;
use App\Announcements;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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

            if ($request->hasFile('announcementBasis')) {
                $announcementBasis = $this->loadFile($request, 'announcementBasis', 'announcement/files', 'announcements');
            }

            if ($request->hasFile('announcementResultCV')) {
                $announcementResultCV = $this->loadFile($request, 'announcementResultCV', 'announcement/files', 'announcements');
            }

            if ($request->hasFile('announcementFinalResult')) {
                $announcementFinalResult = $this->loadFile($request, 'announcementFinalResult', 'announcement/files', 'announcements');
            }


            $document->nombre = $data['announcementTitle'];
            $document->idconvocatoria_categoria = $data['categoryId'];
            $document->descripcion = $data['announcementDescription'];
            $document->archivo = $announcementBasis ?? '';
            $document->archivo_eva =  $announcementResultCV ?? '';
            $document->archivo_final =  $announcementFinalResult ?? '';
            $document->save();

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

            $document = Announcements::find($id);

            $data = $request->all();
            // echo '<pre>'; print_r($data); die;

            if ($request->hasFile('announcementBasis')) {
                $announcementBasis = $this->loadFile($request, 'announcementBasis', 'announcement/files', 'announcements');
            } else {
                $announcementBasis = $data['currentAnnouncementBasis'] ?? "";
            }

            if ($request->hasFile('announcementResultCV')) {
                $announcementResultCV = $this->loadFile($request, 'announcementResultCV', 'announcement/files', 'announcements');
            } else {
                $announcementBasis = $data['currentAnnouncementResultCV'] ?? "";
            }

            if ($request->hasFile('announcementFinalResult')) {
                $announcementFinalResult = $this->loadFile($request, 'announcementFinalResult', 'announcement/files', 'announcements');
            } else {
                $announcementBasis = $data['currentAnnouncementFinalResult'] ?? "";
            }

            $document->nombre = $data['announcementTitle'];
            $document->idconvocatoria_categoria = $data['categoryId'];
            $document->descripcion = $data['announcementDescription'];
            $document->archivo = $announcementBasis ?? '';
            $document->archivo_eva =  $announcementResultCV ?? '';
            $document->archivo_final =  $announcementFinalResult ?? '';

            $document->update();

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
        return view('admin.announcements.edit_announcement')->with(compact('categories_drop_down', 'announcementDetail', 'companyData'));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function deleteDocument($id)
    {
        Announcements::find($id)->delete();
        $message = 'El documento se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.documents.index');
    }
}
