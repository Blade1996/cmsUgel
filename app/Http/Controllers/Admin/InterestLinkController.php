<?php

namespace App\Http\Controllers\Admin;

use App\InterestLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class InterestLinkController extends Controller
{
    public function index()
    {
        Session::put('page', 'interest-link');
        $links = InterestLink::get();
        $companyData = getCompanyData();
        return view('admin.interestLink.interestLink')->with(compact('links', 'companyData'));
    }

    public function addLink(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            /* echo '<pre>'; print_r($data['sectionName']); die; */

            $link = new InterestLink;

            $rulesData = [
                'titleLink' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
            ];

            $customMessage = [
                'titleLink.required' => 'El campo nombre es requerido',
                'titleLink.regex' => 'El campo nombre no es válido',
            ];

            $this->validate($request, $rulesData, $customMessage);

            if (!File::exists('images/backend_images/links')) {
                $path = 'images/admin_images/links';
                File::makeDirectory($path, 0755, true, true);
            }

            // Upload Image
            if ($request->hasFile('iconLink')) {
                $image_tmp = $request->file('iconLink');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/articles/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $link->url_icon = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }

            $link->title = $data['titleLink'] ?? '';
            $link->url_redirect = $data['redirectLink'] ?? '';
            $link->save();

            $message = 'El Link se agrego correctamente';
            Session::flash('success_message', $message);
            return redirect()->route('dashboard.links.index');
        }
        $companyData = getCompanyData();
        return view('admin.interestLink.add_interestLink', compact('companyData'));
    }

    public function editLink(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            /*  echo '<pre>';
            print_r($data);
            die; */

            $rulesData = [
                'titleLink' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
            ];

            $customMessage = [
                'titleLink.required' => 'El campo nombre es requerido',
                'titleLink.regex' => 'El campo nombre no es válido',
            ];

            $this->validate($request, $rulesData, $customMessage);

            // Upload Image
            if ($request->hasFile('iconLink')) {
                $image_tmp = $request->file('iconLink');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/articles/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePath = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentIconLink'])) {
                $completePath = $data['currentIconLink'];
            } else {
                $completePath = '';
            }

            InterestLink::where(['id' => $id])->update(['title' => $data['titleLink'] ?? '', 'url_icon' => $completePath, 'url_redirect' => $data['redirectLink'] ?? '']);

            $message = 'El Link se actualizo correctamente';
            Session::flash('success_message', $message);
            return redirect()->route('dashboard.links.index');
        }
        $companyData = getCompanyData();
        $linkDetail = InterestLink::where(['id' => $id])->first();
        return view('admin.interestLink.edit_interestLink
        ')->with(compact('linkDetail', 'companyData'));
    }

    public function deleteLink($id)
    {
        InterestLink::find($id)->delete();
        $message = 'El Link se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.links.index');
    }
}
