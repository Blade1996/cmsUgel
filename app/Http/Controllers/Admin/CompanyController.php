<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Company;
use Image;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{


    public function index(Request $request)
    {
        Session::put('page', 'Company');

        if ($request->isMethod('post')) {
            $data = $request->all();

            echo '<pre>';
            print_r($data);
            die;


            $rulesData = [
                'companyName' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'companyAddress' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'companyPhone' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'companyCamapignImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'companyImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'companyIcon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'registerDescription' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'companySeoTitle' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'companySeoDescription' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'companySeoImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];


            $customMessage = [
                'companyName.required' => 'El campo nombre es requerido',
                'companyName.regex' => 'El campo nombre no es válido',
                'companyAddress.regex' => 'El campo direccion no es válido',
                'companyPhone.regex' => 'El campo telefono no es válido',
                'companyCamapignImage.mimes' => 'Formato invalido, formatos soportados: jpeg, png, jpg, gif, svg',
                'companyCamapignImage.max' => 'La imagen no debe pesar mas de 2MB',
                'companyImage.mimes' => 'Formato invalido, formatos soportados: jpeg, png, jpg, gif, svg',
                'companyIcon.mimes' => 'Formato invalido, formato soportado:png',
                'companyIcon.max' => 'La imagen no debe pesar mas de 2MB',
                'companySeoTitle.regex' => 'El campo titulo SEO no es válido',
                'companySeoDescription.regex' => 'El campo descripcion SEO no es válido',
                'companySeoImage.mimes' => 'Formato invalido, formatos soportados: jpeg, png, jpg, gif, svg',
                'companySeoImage.max' => 'La imagen no debe pesar mas de 2MB',
            ];

            // Upload Image
            if ($request->hasFile('companyCamapignImage')) {
                $image_tmp = $request->file('companyCamapignImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePathCampaign = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentCamapignImage'])) {
                $completePathCampaign = $data['currentCamapignImage'];
            } else {
                $completePathCampaign = '';
            }

            if ($request->hasFile('companyImage')) {
                $image_tmp = $request->file('companyImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePathCompany = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentCompanyImage'])) {
                $completePathCompany = $data['currentCompanyImage'];
            } else {
                $completePathCompany = '';
            }

            if ($request->hasFile('companyIcon')) {
                $image_tmp = $request->file('companyIcon');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/' . $fileName;
                    Image::make($image_tmp)->encode('png', 75)->save($large_image_path);
                    $completePathIcon = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentCompanyIcon'])) {
                $completePathIcon = $data['currentCompanyIcon'];
            } else {
                $completePathIcon = '';
            }

            if ($request->hasFile('modalImage')) {
                $image_tmp = $request->file('modalImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/' . $fileName;
                    Image::make($image_tmp)->encode('png', 75)->save($large_image_path);
                    $completePathModal = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentModalImage'])) {
                $completePathModal = $data['currentModalImage'];
            } else {
                $completePathModal = '';
            }

            if ($request->hasFile('companySeoImage')) {
                $image_tmp = $request->file('companySeoImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/' . $fileName;
                    Image::make($image_tmp)->encode('png', 75)->save($large_image_path);
                    $completePathSeo = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentCompanySeoImage'])) {
                $completePathSeo = $data['currentCompanySeoImage'];
            } else {
                $completePathSeo = '';
            }

            if (!empty($data['redirectModal'])) {
                $completeRedirect = $data['redirectModal'];
            } else {
                $completeRedirect = $data['currentRedirectModal'];
            }

            Company::where('code', env('CODE_COMPANY'))->update([
                'name' => $data['companyName'], 'companyInfo->url_logo' => $completePathCampaign,
                'companyInfo->company_address' => $data['companyAddress'], 'companyInfo->company_phone' => $data['companyPhone'], 'companyInfo->url_company' => $completePathCompany, 'companyInfo->url_icon' => $completePathIcon, 'companySeo->title' => $data['companySeoTitle'], 'companySeo->description' => $data['companySeoDescription'], 'companySeo->url_image' => $completePathSeo, 'first_image' => $completePathModal, 'redirect_first_image' => $completeRedirect ?? '', 'companyInfo->year_name' => $data['yearName'] ?? '', 'attention_time->presencial->from' => $data['fromPresencial'], 'attention_time->presencial->to' => $data['toPresencial'], 'attention_time->virtual->from' => $data['fromVirtual'], 'attention_time->presencial->to' => $data['toVirtual'], 'attention_time->wsp->from' => $data['fromWsp'], 'attention_time->wsp->to' => $data['toWsp']
            ]);
            Session::flash('success_message', 'Los datos se guardaron Correctamente');
            return redirect()->route('dashboard.company');
        }
        $companyData = getCompanyData();
        return view('admin.company.help_center')->with(compact('companyData'));
    }

    public function policies(Request $request, $name = null)
    {
        Session::put('page', 'policies');

        if ($request->isMethod('post')) {
            $data = $request->all();

            /*  echo '<pre>';
            print_r($data);
            die; */

            $rulesData = [
                $name . 'Title' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                // $name . 'Description' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                $name . 'SeoTitle' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                $name . 'SeoDescription' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                $name . 'SeoImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];

            if (!empty($data['beforeRegister'])) {
                $beforeRegister = $data['beforeRegister'];
            }

            $customMessage = [
                $name . 'Title.regex' => 'El campo titulo no es válido',
                $name . 'Description.regex' => 'El campo descripcion no es válido',
                $name . 'SeoTitle.regex' => 'El campo titulo SEO no es válido',
                $name . 'SeoDescription.regex' => 'El campo descripcion SEO no es válido',
                $name . 'SeoImage.mimes' => 'Formato invalido, formatos soportados: jpeg, png, jpg, gif, svg',
                $name . 'SeoImage.max' => 'La imagen no debe pesar mas de 2MB',
            ];

            $this->validate($request, $rulesData, $customMessage);

            $company = new Company;
            $slugClean = $company->cleanSlug(strtolower($data[$name . 'Title']));
            $slug = strtr(strtolower($slugClean), ' ', '-');

            if ($request->hasFile($name . 'SeoImage')) {
                $image_tmp = $request->file($name . 'SeoImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/' . $fileName;
                    Image::make($image_tmp)->encode('png', 75)->save($large_image_path);
                    $completePathSeo = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['current' . $name . 'SeoImage'])) {
                $completePathSeo = $data['current' . $name . 'SeoImage'];
            } else {
                $completePathSeo = '';
            }

            if ($name == 'helpCenter') {
                Company::where('code', env('CODE_COMPANY'))->update(['beforeRegister' => $beforeRegister, $name . '->title' => $data[$name . 'Title'], $name . '->description' => $data[$name . 'Description'], $name . '->seoTitle' => $data[$name . 'SeoTitle'], $name . '->seoDescription' => $data[$name . 'SeoDescription'], $name . '->seoImage' => $completePathSeo]);
            }

            Company::where('code', env('CODE_COMPANY'))->update([$name . '->title' => $data[$name . 'Title'], $name . '->description' => $data[$name . 'Description'], $name . '->slug' => $slug, $name . '->seoTitle' => $data[$name . 'SeoTitle'], $name . '->seoDescription' => $data[$name . 'SeoDescription'], $name . '->seoImage' => $completePathSeo]);
            Session::flash('success_message', 'Los datos se guardaron Correctamente');
            return redirect()->route('dashboard.policies');
        }
        $companyData = getCompanyData();
        $companyPolicies = getCompanyData();
        return view('admin.company.policies')->with(compact('companyPolicies', 'companyData'));
    }

    public function addCompany(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $company = new Company;

            $company->helpCenter = [
                'title' => $data['helpCenterTitle'],
                'Description' => $data['helpCenterContent'],
            ];

            $company->save();
            Session::flash('success_message', 'Los datos se guardaron Correctamente');
            return redirect('dashboard/help-center');
        }
        return view('admin.company.help_center');
    }
}
