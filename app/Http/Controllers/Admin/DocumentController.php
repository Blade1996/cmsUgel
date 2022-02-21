<?php

namespace App\Http\Controllers\Admin;

use App\Documents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
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


            if (!File::exists('documents')) {
                $path = 'documents';
                File::makeDirectory($path, 0755, true, true);
            }

            // Upload Image
            if ($request->hasFile('documentFile')) {
                $documentFile = $this->loadFile($request, 'documentFile', 'documents', 'documents');
            }

            if ($request->hasFile('documentBasis')) {
                $documentBasis = $this->loadFile($request, 'documentBasis', 'documents', 'documents');
            }

            if ($request->hasFile('documentResultCV')) {
                $documentResultCV = $this->loadFile($request, 'documentResultCV', 'documents', 'documents');
            }

            if ($request->hasFile('documentFinalResult')) {
                $documentFinalResult = $this->loadFile($request, 'documentFinalResult', 'documents', 'documents');
            }

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
            Session::flash('success_message', 'El documento se creo Correctamente');
            return redirect()->route('dashboard.documents.index');
        }
        $slug = $type;
        $companyData = getCompanyData();
        return view('admin.documents.add_document')->with(compact('companyData', 'slug'));
    }


    public function editDocument(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {

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

            // Upload Image
            if ($request->hasFile('documentFile')) {
                $completePath = $this->loadFile($request, 'documentFile', 'documents', 'documents');
            } else if (!empty($data['currentDocumentFile'])) {
                $completePath = $data['currentDocumentFile'];
            } else {
                $completePath = '';
            }

            if ($request->hasFile('documentBasis')) {
                $data['url_file'] = $this->loadFile($request, 'documentBasis', 'documents', 'documents');
            } else if (!empty($data['currentDocumentBasis'])) {
                $completePathBasis = $data['currentDocumentBasis'];
            } else {
                $completePathBasis = '';
            }

            if ($request->hasFile('documentResultCV')) {
                $data['url_file'] = $this->loadFile($request, 'documentResultCV', 'documents', 'documents');
            } else if (!empty($data['currentDocumentResultCV'])) {
                $completePathCV = $data['currentDocumentResultCV'];
            } else {
                $completePathCV = '';
            }

            if ($request->hasFile('documentFinalResult')) {
                $data['url_file'] = $this->loadFile($request, 'documentFinalResult', 'documents', 'documents');
            } else if (!empty($data['currentDocumentFinalResult'])) {
                $completePathFinal = $data['currentDocumentFinalResult'];
            } else {
                $completePathFinal = '';
            }

            if (!empty($data['categoryId'])) {
                $categoryId = $data['categoryId'];
            } else {
                $categoryId = $data['currentCategoryId'];
            }

            Documents::where(['id' => $id])->update(['title' => $data['documentTitle'], 'description' => $data['documentDescription'], 'url_file' => $completePath, 'slug' => $slug, 'url_basis' => $completePathBasis ?? '', 'result_cv' => $completePathBasis ?? '', 'result_final' => $completePathFinal, 'category_id' => $categoryId]);

            Session::flash('success_message', 'El documento se Actualizo Correctamente');
            return redirect()->route('dashboard.documents.index');
        }

        $documentDetail = Documents::where(['id' => $id])->first();
        $companyData = getCompanyData();
        return view('admin.documents.edit_document')->with(compact('documentDetail', 'companyData'));
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

    public function storeMedia(Request $request, $slug = null)
    {
        $path = public_path('tmp/uploads/' . $slug . '/');

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
