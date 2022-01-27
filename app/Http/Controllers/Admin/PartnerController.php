<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Partner;
use App\Company;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    //
    public function listPartners()
    {
        $companyData = getCompanyData();
        Session::put('page', 'partners');

        $partners = Partner::get();
        return view('admin.partners.partners')->with(compact('partners', 'companyData'));
    }

    public function addPartner(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            /* echo '<pre>'; print_r($data['partnerName']); die; */

            $partner = new Partner;

            $rulesData = [
                'partnerName' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/'
            ];

            $customMessage = [
                'partnerName.required' => 'El campo nombre es requerido',
                'partnerName.regex' => 'El campo nombre no es válido',
                'partnerLogo.mimes' => 'Formato invalido, formatos soportados: jpeg, png, jpg, gif, svg',
                'partnerLogo.max' => 'La imagen no debe pesar mas de 2MB',
            ];

            $this->validate($request, $rulesData, $customMessage);

            $slug = Str::slug($data['partnerName']);

            if ($request->hasFile('partnerLogo')) {
                $image_tmp = $request->file('partnerLogo');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $partner->logo = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }

            $partner->name = $data['partnerName'];
            $partner->url = $data['partnerUrl'];
            $partner->save();

            $message = 'El Partner se agrego correctamente';
            Session::flash('success_message', $message);
            return redirect('/admin/dashboard/partners');
        }
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.partners.add_partner', compact('companyData'));
    }


    public function editPartner(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            /*   echo '<pre>';
            print_r($data);
            die;
 */
            $rulesData = [
                'partnerName' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/'
            ];

            $customMessage = [
                'partnerName.required' => 'El campo nombre es requerido',
                'partnerName.regex' => 'El campo nombre no es válido',
                'partnerLogo.mimes' => 'Formato invalido, formatos soportados: jpeg, png, jpg, gif, svg',
                'partnerLogo.max' => 'La imagen no debe pesar mas de 2MB',
            ];

            $this->validate($request, $rulesData, $customMessage);

            $partner = new Partner();
            $slug = Str::slug($data['partnerName']);

            if ($request->hasFile('partnerLogo')) {
                $image_tmp = $request->file('partnerLogo');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePathLogo = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentPartnerLogo'])) {
                $completePathLogo = $data['currentPartnerLogo'];
            } else {
                $completePathLogo = '';
            }

            Partner::where(['id' => $id])->update(['name' => $data['partnerName'], 'url' => $data['partnerUrl'], 'logo' => $completePathLogo]);

            $message = 'El se actualizo correctamente';
            Session::flash('success_message', $message);
            return redirect()->route('dashboard.partners');
        }
        $company = new Company;
        $companyData = getCompanyData();
        $partnerDetail = Partner::where(['id' => $id])->first();
        return view('admin.partners.edit_partner')->with(compact('partnerDetail', 'companyData'));
    }

    public function deletePartner($id)
    {
        Partner::find($id)->delete();
        $message = 'El Partner se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect('/admin/dashboard/partners');
    }

}
