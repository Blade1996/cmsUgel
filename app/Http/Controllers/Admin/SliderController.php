<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;
use App\Company;
use Session;
use Image;
use DateTime;
use DateTimeZone;
use File;

class SliderController extends Controller
{
    public function index()
    {
        Session::put('page', 'slider');
        $sliders = Article::orderBy('order')->where('idarticulo_categoria', 11)->get();
        $companyData = getCompanyData();
        return view('admin.slider.slider')->with(compact('sliders', 'companyData'));
    }

    public function updateSliderStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Activado') {
                $status = 0;
            } else {
                $status = 1;
            }
            Article::where('id', $data['id'])->update(['estado' => $status]);
            return response()->json(['status' => $status, 'id' => $data['id']]);
        }
    }


    public function updateOrder(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            /* echo '<pre>'; print_r($data); die; */
            $slider = Article::find($data['id_slide']);
            $slider->order = $data['order'];
            $slider->update();
            return response()->json(['status' => 'Ordenado Correctamente']);
        }
    }

    /*

    public function addSlider(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $slider = new Slider;
            $title = 'imagen ' . strval(Slider::count() + 1);
            $slug = strtr(strtolower($title), ' ', '-');
            $route = strtr(strtolower($title), ' ', '-');

            if (!File::exists('images/admin_images/slider')) {
                $path = 'images/admin_images/slider';
                File::makeDirectory($path, 0777, true, true);
            };

            // Upload Image
            if ($request->hasFile('sliderImage')) {
                $image_tmp = $request->file('sliderImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $banner_path = 'images/admin_images/slider/' . $fileName;
                    Image::make($image_tmp)->save($banner_path);
                    $slider->url_image = env('URL_DOMAIN') . '/' . $banner_path;
                }
            }

            if (!empty($data['showCaption'])) {
                $slider->show_caption = 1;
                $slider->title_caption = $data['titleCaption'] ?? '';
                $slider->subtitle_caption = $data['subTitleCaption'] ?? '';
            }

            $slider->title = $title;
            $slider->slug = $slug;
            $slider->route = $route;
            $slider->order = Slider::count() + 1;
            $slider->created_at = new DateTime('now', new DateTimeZone('America/Lima'));
            $slider->updated_at = new DateTime('now', new DateTimeZone('America/Lima'));

            $slider->save();
            Session::flash('success_message', 'El slider se creo Correctamente');
            return redirect()->route('dashboard.slider.index');
        }
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.slider.add_slider', compact('companyData'));
    } */

    public function editSlider(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $slider = Article::find($id);

            // Upload Image
            if ($request->hasFile('sliderImage')) {
                $slider->imagen_slider = $this->loadFile($request, 'sliderImage', 'sliders', 'sliders');
            } else if (!empty($data['currentSliderImage'])) {
                $slider->imagen_slider = $data['currentSliderImage'];
            } else {
                $slider->imagen_slider = '';
            }

            $slider->update();

            Session::flash('success_message', 'El slider se actualizo Correctamente');
            return redirect()->route('dashboard.slider.index');
        }
        $companyData = getCompanyData();
        $sliderDetails = Article::where('id', $id)->first();
        return view('admin.slider.edit_slider')->with(compact('sliderDetails', 'companyData'));
    }

    public function deleteSlider($id)
    {
        Article::find($id)->delete();
        $message = 'El slider se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->back();
    }
}
