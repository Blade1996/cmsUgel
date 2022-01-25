<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'category');
        $categories = Category::get();
        $companyData = getCompanyData();
        return view('admin.category.categories')->with(compact('categories', 'companyData'));
    }
    
    
        public function addCategory(Request $request)
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
            return redirect()->route('dashboard.categories.index');
        }

        $companyData = getCompanyData();
        return view('admin.category.add_category', compact('companyData'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
