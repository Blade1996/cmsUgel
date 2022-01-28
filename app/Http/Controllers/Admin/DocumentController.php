<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Documents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use League\CommonMark\Block\Element\Document;

class DocumentController extends Controller
{

    private $mediaCollection = 'files';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'list-documents');
        $documents = Documents::where('category_id', 1)->get();
        $title = 'Documentos Generales';
        $slug = 'documentos-generales';
        $companyData = getCompanyData();
        return view('admin.documents.documents')->with(compact('documents', 'companyData', 'title', 'slug'));
    }

    public function addDocument(Request $request, $type = null)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $document = new Documents;

            $rulesData = [
                'categoryId' => 'nullable',
                'documentTitle' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'documentDescription' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/'
            ];

            $customMessage = [
                'documentTitle.required' => 'El campo titulo es requerido',
                'documentTitle.regex' =>  'El campo titulo es invalido',
                'documentDescription.regex' => 'El campo descripcion seo no es válido',
            ];

            $this->validate($request, $rulesData, $customMessage);

            $slug = Str::slug($data['documentTitle']);

            $document->title = $data['documentTitle'];
            $document->slug = $slug;
            $document->route = $slug;
            $document->category_id = $data['categoryId'];
            $document->description = $data['documentDescription'];
            $document->url_file = $documentFile ?? '';
            $document->url_basis = $documentBasis ?? '';
            $document->result_cv =  $documentResultCV ?? '';
            $document->result_final =  $documentFinalResult ?? '';
            $document->save();

            foreach ($request->input('files', []) as $file) {
                $document->addMedia(public_path('tmp/uploads/documents/' . $file))->toMediaCollection($this->mediaCollection);
            }

            Session::flash('success_message', 'El documento se creo Correctamente');
            return redirect()->route('dashboard.documents.index');
        }
        $slug = $type;
        $companyData = getCompanyData();
        return view('admin.documents.add_document')->with(compact('companyData', 'slug'));
    }

    public function storeMedia(Request $request)
    {
        $path = public_path('tmp/uploads/documents/');

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



    public function editDocument(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {

            $documents = Documents::with('files')->find($id);

            $data = $request->all();
            // echo '<pre>'; print_r($data); die;
            $rulesData = [
                'categoryId' => 'nullable',
                'documentTitle' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'documentDescription' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/'
            ];

            $customMessage = [
                'documentTitle.required' => 'El campo titulo es requerido',
                'documentTitle.regex' =>  'El campo titulo es invalido',
                'documentDescription.regex' => 'El campo descripcion seo no es válido',
            ];

            $this->validate($request, $rulesData, $customMessage);

            $slug = Str::slug($data['documentTitle']);

            //echo '<pre>'; print_r($slug); die;

            if (!empty($data['categoryId'])) {
                $categoryId = $data['categoryId'];
            } else {
                $categoryId = $data['currentCategoryId'];
            }

            $documents->update(['title' => $data['documentTitle'], 'description' => $data['documentDescription'], 'slug' => $slug, 'category_id' => $categoryId]);

            if (count($documents->files) > 0) {
                foreach ($documents->files as $media) {
                    if (!in_array($media->file_name, $request->input('files', []))) {
                        $media->delete();
                    } else {
                    }
                }
            }

            $media = $documents->files->pluck('file_name')->toArray();

            foreach ($request->input('files', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $documents->addMedia(public_path('tmp/uploads/documents/' . $file))->toMediaCollection($this->mediaCollection);
                }
            }

            Session::flash('success_message', 'El documento se Actualizo Correctamente');
            return redirect()->route('dashboard.documents.index');
        }

        $documentDetail = Documents::where(['id' => $id])->first();
        $files = $documentDetail->getMedia($this->mediaCollection);
        $companyData = getCompanyData();
        return view('admin.documents.edit_document')->with(compact('documentDetail', 'companyData', 'files'));
    }


    public function announcements()
    {
        Session::put('page', 'announcements');
        $title = 'Convocatorias';
        $slug = 'convocatorias';
        $documents = Documents::where('category_id', 2)->get();
        $companyData = getCompanyData();
        return view('admin.documents.documents')->with(compact('documents', 'companyData', 'title', 'slug'));
    }

    public function regulations()
    {
        Session::put('page', 'regulations');
        $title = 'Normativas';
        $slug = 'normativas';
        $documents = Documents::where('category_id', 3)->get();
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        Documents::find($id)->delete();
        $message = 'El documento se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.documents.index');
    }
}
