<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Documents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\CommonMark\Block\Element\Document;

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
        $documents = Documents::get();
        $companyData = getCompanyData();
        return view('admin.documents.documents')->with(compact('documents', 'companyData'));
    }

    public function addDocument(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $article = new Documents;

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
                $data['url_file'] = $this->loadFile($request, 'documentFile', 'documents', 'documents');
            }


            $article->title = $data['documentTitle'];
            $article->section_id = $data['documentDescription'];
            $article->url_file = !empty($data['url_file']) ? $data['url_file'] : '';

            $article->save();
            Session::flash('success_message', 'El documento se creo Correctamente');
            return redirect()->route('dashboard.documents.index');
        }

        $categories = Category::get();

        $category_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $category) {
            $category_drop_down .= "<option value='" . $category->id . "'>" . $category->name . "</option>";
        }

        $companyData = getCompanyData();
        return view('admin.documents.add_document')->with(compact('category_drop_down', 'companyData'));
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
                'articleImage.mimes' => 'Formato invalido, formatos soportados: jpeg, png, jpg, gif, svg',
                'articleImage.max' => 'La imagen no debe pesar mas de 2MB',
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

            Documents::where(['id' => $id])->update(['title' => $data['documentTitle'], 'description' => $data['documentDescription'], 'url_file' => $completePath, 'slug' => $slug ]);

            Session::flash('success_message', 'El documento se Actualizo Correctamente');
            return redirect()->route('dashboard.documents.index');
        }

        $documentDetail = Documents::where(['id' => $id])->first();
        $categories = Category::get();
        $category_drop_down = "<option value='' disabled>Select</option>";
        foreach ($categories as $category) {
            if ($category->id == $documentDetail->category_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $category_drop_down .= "<option value='" . $category->id . "' " . $selected . ">" . $category->name . "</option>";
        }

        $companyData = getCompanyData();
        return view('admin.documents.edit_document')->with(compact('documentDetail', 'category_drop_down', 'companyData'));
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
    public function destroy($id)
    {
        Documents::find($id)->delete();
        $message = 'El documento se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.documents.index');
    }
}
