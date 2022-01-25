<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SubCategory;
use App\Section;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'sub-category');
        $subCategories = SubCategory::get();
        $companyData = getCompanyData();
        return view('admin.subCategory.subCategories')->with(compact('subCategories', 'companyData'));
    }


    public function addSubCategory(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            /* echo '<pre>'; print_r($data['sectionName']); die; */

            $subCategory = new SubCategory;

            $rulesData = [
                'subcategoryName' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
            ];

            $customMessage = [
                'subcategoryName.required' => 'El campo nombre es requerido',
                'subcategoryName.regex' => 'El campo nombre no es válido',
            ];

            $this->validate($request, $rulesData, $customMessage);

            $slug = Str::slug($data['subcategoryName']);


            $subCategory->name = $data['subcategoryName'];
            $subCategory->slug = $slug;
            $subCategory->content = htmlspecialchars_decode(e($data['subcategoryContent']));
            $subCategory->save();

            $message = 'La SubCategoria se agrego correctamente';
            Session::flash('success_message', $message);
            return redirect()->route('dashboard.subcategories.index');
        }
         $sections = Section::get();

        $section_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($sections as $section) {
            $section_drop_down .= "<option value='" . $section->id . "'>" . $section->name . "</option>";
        }
        $companyData = getCompanyData();
        return view('admin.subCategory.add_subCategory', compact('companyData', 'section_drop_down'));
    }
    
    
    public function editSubCategory(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rulesData = [
                'subcategoryName' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
            ];

            $customMessage = [
                'subcategoryName.required' => 'El campo nombre es requerido',
                'subcategoryName.regex' => 'El campo nombre no es válido',
            ];

            $this->validate($request, $rulesData, $customMessage);

        
            $slug = Str::slug($data['subcategoryName']);

            SubCategory::where(['id' => $id])->update([
                'name' => $data['subcategoryName'], 'slug' => $slug,'section_id' => $data['sectionId'],
                'content' => htmlspecialchars_decode(e($data['subcategoryContent'])),
            ]);

            $message = 'La SubCategoria se actualizo correctamente';
            Session::flash('success_message', $message);
            return redirect()->route('dashboard.subcategories.index');
        }
        $companyData = getCompanyData();
        $subCategoryDetail = SubCategory::where(['id' => $id])->first();
        $sections = Section::get();
        $section_drop_down = "<option value='' disabled>Select</option>";
        foreach ($sections as $section) {
            if ($section->id == $subCategoryDetail->section_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $section_drop_down .= "<option value='" . $section->id . "' " . $selected . ">" . $section->name . "</option>";
        }
        return view('admin.subCategory.edit_subCategory')->with(compact('subCategoryDetail', 'companyData', 'section_drop_down'));
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
    public function deleteSubCategory($id)
    {
        SubCategory::find($id)->delete();
        $message = 'El Submenu se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.subcategories.index');
    }
}
