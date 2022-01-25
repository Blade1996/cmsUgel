<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use App\Article;
use App\Company;
use Auth;
use DateTime;
use DateTimeZone;
use Session;
use File;
use Image;

class ArticleController extends Controller
{
    public function index()
    {
        Session::put('page', 'articles');
        $articles = Article::orderBy('published_at', 'desc')->get();
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.articles.articles')->with(compact('articles', 'companyData'));
    }

    public function addArticle(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $article = new Article;

            $rulesData = [
                'sectionId' => 'required',
                'articleSubTitle' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'articleImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'articleResume' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'articleTextLink' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'articleSeoTitle' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'articleSeoDescription' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'articleSeoImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000'

            ];

            $customMessage = [
                'sectionId.required' => 'Debe Seleccionar una seccion',
                'articleImage.mimes' => 'Formato invalido, formatos soportados: jpeg, png, jpg, gif, svg',
                'articleImage.max' => 'La imagen no debe pesar mas de 10MB',
                'articleSubTitle.regex' => 'El campo subtitulo no es válido',
                'articleResume.regex' => 'El campo resumen no es válido',
                'articleTextLink.regex' => 'El campo texto Link no es válido',
                'articleSeoTitle.regex' => 'El campo titulo para el seo no es válido',
                'articleSeoDescription.regex' => 'El campo descripcion seo no es válido',
                'articleSeoImage.mimes' => 'Formato invalido, formatos soportados: jpeg, png, jpg, gif, svg',
            ];

            $this->validate($request, $rulesData, $customMessage);
            $slugClean = $article->cleanSlug(strtolower($data['articleTitle']));

            $slug = strtr(strtolower($slugClean), ' ', '-');
            //echo '<pre>'; print_r($slug); die;

            if (!File::exists('images/backend_images/articles')) {
                $path = 'images/admin_images/articles';
                File::makeDirectory($path, 0755, true, true);
            }

            // Upload Image
            if ($request->hasFile('articleImage')) {
                $image_tmp = $request->file('articleImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/articles/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $article->page_image = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }

            if ($request->hasFile('articleSeoImage')) {
                $image_tmp = $request->file('articleSeoImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/articles/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $article->image_seo = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }
            
            
            if ($request->hasFile('sliderImage')) {
                $image_tmp = $request->file('sliderImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/articles/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $article->slider_image = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }

            if (empty($data['articleUrlVideo'])) {
                $urlVideo = '';
            }
            
             if (!empty($data['subCategoryId'])) {
                $article->sub_category_id = $data['subCategoryId'];
            }

            $article->title = $data['articleTitle'];
            $article->section_id = $data['sectionId'];
            $article->admin_id = Auth::guard('admin')->user()->id;
            $article->subtitle = $data['articleSubTitle'];
            $article->resume = $data['articleResume'];
            $article->show_slider = $data['showSlider'] ?? 0;
            $article->text_link = $data['articleTextLink'];
            $article->title_seo = $data['articleSeoTitle'];
            $article->content_seo = $data['articleSeoDescription'];
            $article->url_video = !empty($data['articleUrlVideo']) ? $data['articleUrlVideo'] : '';
            $article->slug = $slug;
            $article->route = $slug;
            $article->published_at = new DateTime('now', new DateTimeZone('America/Lima'));
            $article->content = htmlspecialchars_decode(e($data['articleContent']));

            $article->save();
            Session::flash('success_message', 'El articulo se creo Correctamente');
            return redirect()->route('dashboard.articles.index');
        }

        $sections = Section::get();

        $section_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($sections as $section) {
            $section_drop_down .= "<option value='" . $section->id . "'>" . $section->name . "</option>";
        }
        $section_drop_down .= "<option value='100'>slider</option>";
        $section_drop_down .= "<option value='200'>noticias</option>";
        $section_drop_down .= "<option value='300'>enlaces de interes</option>";
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.articles.add_article')->with(compact('section_drop_down', 'companyData'));
    }

    public function editArticle(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {

            $data = $request->all();
            // echo '<pre>'; print_r($data); die;
            $rulesData = [
                'articleSubTitle' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'articleImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'articleResume' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'articleTextLink' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'articleSeoTitle' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'articleSeoDescription' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'articleSeoImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];


            $customMessage = [
                'articleSubTitle.regex' => 'El campo subtitulo no es válido',
                'articleImage.mimes' => 'Formato invalido, formatos soportados: jpeg, png, jpg, gif, svg',
                'articleImage.max' => 'La imagen no debe pesar mas de 2MB',
                'articleResume.regex' => 'El campo resumen no es válido',
                'articleTextLink.regex' => 'El campo texto Link no es válido',
                'articleSeoTitle.regex' => 'El campo titulo para el seo no es Valido',
                'articleSeoDescription.regex' => 'El campo descripcion para el seo no es Valido',
                'articleSeoImage.mimes' => 'Formato invalido, formatos soportados: jpeg, png, jpg, gif, svg',

            ];

            $this->validate($request, $rulesData, $customMessage);
            $article = new Article();
            $slugClean = $article->cleanSlug(strtolower($data['articleTitle']));

            $slug = strtr(strtolower($slugClean), ' ', '-');
            $route = strtr(strtolower($data['articleTitle']), ' ', '-');

            //echo '<pre>'; print_r($slug); die;

            // Upload Image
            if ($request->hasFile('articleImage')) {
                $image_tmp = $request->file('articleImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/articles/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePath = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentArticleImage'])) {
                $completePath = $data['currentArticleImage'];
            } else {
                $completePath = '';
            }

            if ($request->hasFile('articleSeoImage')) {
                $image_tmp = $request->file('articleSeoImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/articles/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePathSeo = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentArticleSeoImage'])) {
                $completePathSeo = $data['currentArticleSeoImage'];
            } else {
                $completePathSeo = '';
            }
            
              if ($request->hasFile('sliderImage')) {
                $image_tmp = $request->file('articleSeoImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/articles/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePathSeo = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentSliderImage'])) {
                $completePathSeo = $data['currentSliderImage'];
            } else {
                $completePathSeo = '';
            }


            if (!empty($data['subCategoryId'])) {
                $subCatId = $data['subCategoryId'];
            } else {
                $subCatId = 0;
            }


            Article::where(['id' => $id])->update(['title' => $data['articleTitle'], 'subtitle' => $data['articleSubTitle'], 'show_slider' => $data['showSlider'] ?? 0 , 'route' => $slug, 'slug' => $slug, 'content' => htmlspecialchars_decode(e($data['articleContent'])), 'section_id' => $data['sectionId'], 'page_image' => $completePath, 'resume' => $data['articleResume'], 'text_link' => $data['articleTextLink'], 'title_seo' => $data['articleSeoTitle'], 'content_seo' => $data['articleSeoDescription'], 'image_seo' => $completePathSeo, 'url_video' => $data['articleUrlVideo'], 'sub_category_id' => $subCatId, 'slider_image' => $data['sliderImage']]);

            Session::flash('success_message', 'El articulo se Actualizo Correctamente');
            return redirect()->route('dashboard.articles.index');
        }

        $articleDetail = Article::where(['id' => $id])->first();
        $sections = Section::get();
        $sectionClass = new SectionController;
        $sectionDetail = $sectionClass->sectionDetails($articleDetail->section_id);
        $subcat_drop_down = '';
        if (!empty($sectionDetail->sub_categories) && count($sectionDetail->sub_categories) > 0) {
            $subcat_drop_down = "<option value='' disabled>Select</option>";
            foreach ($sectionDetail->sub_categories as $subCategory) {
                if ($subCategory->id == $articleDetail->sub_category_id) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }

                $subcat_drop_down .= "<option value='" . $subCategory->id . "' " . $selected . ">" . $subCategory->name . "</option>";
            }
        }

        $section_drop_down = "<option value='' disabled>Select</option>";
        foreach ($sections as $section) {
            if ($section->id == $articleDetail->section_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $section_drop_down .= "<option value='" . $section->id . "' " . $selected . ">" . $section->name . "</option>";
        }
        $section_drop_down .= "<option value='100'>slider</option>";
        $section_drop_down .= "<option value='200'>noticias</option>";
        $section_drop_down .= "<option value='300'>enlaces de interes</option>";
        $company = new Company;
        $companyData = getCompanyData();
        return view('admin.articles.edit_article')->with(compact('articleDetail', 'section_drop_down', 'companyData', 'subcat_drop_down'));
    }

    public function deleteArticle($id)
    {
        Article::find($id)->delete();
        $message = 'La Seccion se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('dashboard.articles.index');
    }
}
