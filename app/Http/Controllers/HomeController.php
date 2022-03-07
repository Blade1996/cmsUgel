<?php

namespace App\Http\Controllers;

use App\Charge;
use App\Slider;
use App\Article;
use App\Partner;
use App\Section;
// use App\Announcement;
use App\Reassign;
use App\Documents;
use App\Normativity;
use App\InterestLink;
use App\Announcements;
use App\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{

    private $mediaCollection = 'files';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $partners = Partner::get();
        $articles = Article::select('id', 'titulo', 'imagen', 'creado')->where('id', '<>', 5)->take(3)->get();
        $announcements = Announcements::select('id', 'nombre', 'imagen', 'fecha')->take(3)->get();
        $links = Article::where('idarticulo_categoria', 10)->get();
        $collection = collect($links);
        $linksArray = $collection;
        $linksArray->toArray();
        $normativities = Normativity::select('id', 'nombre', 'imagen', 'fecha')->take(3)->get();
        $sections = DB::table('dx_articulo_categoria')->select('id', 'titulo')->where([['id', '<>', 5], ['id', '<>', 9]])->get();
        $sections->each(function ($section) {
            $section->articles =  Article::select('id', 'titulo')->where('idarticulo_categoria', $section->id)->get();
        });
        $gestions = Article::select('id', 'titulo', 'imagen', 'creado')->where('id', '<>', 9)->take(3)->get();
        $partners = Partner::get();
        $slider = Slider::orderBy('order')->get();
        $companyData = getCompanyData();
        return view('frontend.home')->with([
            'companyData' => $companyData, 'sections' => $sections, 'partners' => $partners, 'sliders' => $slider, 'articles' => $articles, 'gestions' => $gestions, 'announcements' => $announcements, 'normativities' => $normativities, 'linksArray' => $linksArray
        ]);
        /*   $companyData = getCompanyData();
        $sections = Section::where([['id', '<>', 5], ['id', '<>', 6], ['id', '<>', 7]])->get();
        $links = Article::where('section_id', 7)->get();
        $collection = collect($links);
        $linksArray = $collection;
        $linksArray->toArray();
        $regulations = Documents::where('category_id', 3)->get();
        $announcements = Documents::where('category_id', 2)->latest()->take(3)->get();
        return view('frontend.home')->with([
            'companyData' => $companyData, 'sections' => $sections, 'partners' => $partners, 'linksArray' => $linksArray, 'sliders' => $slider, 'articles' => $articles, 'announcements' => $announcements, 'regulations' => $regulations
        ]); */
    }

    public function indexDocuments()
    {
        $documents = Documents::where('category_id', 1)->latest()->paginate(4);
        $sections = DB::table('dx_articulo_categoria')->select('id', 'titulo')->where([['id', '<>', 5], ['id', '<>', 9]])->get();
        $sections->each(function ($section) {
            $section->articles =  Article::select('id', 'titulo')->where('idarticulo_categoria', $section->id)->get();
        });
        $companyData = getCompanyData();
        return view('frontend.documents')->with(compact('documents', 'companyData', 'sections'));
    }

    public function indexContact()
    {
        $sections = DB::table('dx_articulo_categoria')->select('id', 'titulo')->where([['id', '<>', 5], ['id', '<>', 9]])->get();
        $sections->each(function ($section) {
            $section->articles =  Article::select('id', 'titulo')->where('idarticulo_categoria', $section->id)->get();
        });
        $companyData = getCompanyData();
        return view('frontend.contact')->with(compact('companyData', 'sections'));
    }

    public function indexArticles()
    {
        $articles = Article::where('idarticulo_categoria', 5)->orderBy('creado', 'desc')->paginate(4);
        $sections = DB::table('dx_articulo_categoria')->select('id', 'titulo')->where([['id', '<>', 5], ['id', '<>', 9]])->get();
        $sections->each(function ($section) {
            $section->articles =  Article::select('id', 'titulo')->where('idarticulo_categoria', $section->id)->get();
        });
        $companyData = getCompanyData();
        return view('frontend.noticias')->with(compact('companyData', 'articles', 'sections'));
    }

    public function indexNormativity(Request $request)
    {
        // $reasigns = Reassign::orderBy('fecha')->title($request->search)->category($request->categoryId)->paginate(4);
        if (!empty($request->categoryId)) {
            $normativities = Normativity::orderBy('fecha')->category($request->categoryId)->paginate(4);
            $normativities->appends(['categoryId' => $request->categoryId]);
        } else if (!empty($request->search)) {
            $normativities = Normativity::orderBy('fecha')->title($request->search)->paginate(4);
            $normativities->appends(['search' => $request->search]);
        } else {
            $normativities = Normativity::orderBy('fecha')->paginate(4);
        }
        $categories = DB::table('dx_disposicion_categoria')->get(['id', 'titulo']);
        $sections = DB::table('dx_articulo_categoria')->where([['id', '<>', 5], ['id', '<>', 9]])->get(['id', 'titulo']);
        $sections->each(function ($section) {
            $section->articles =  Article::select('id', 'titulo')->where('idarticulo_categoria', $section->id)->get();
        });
        $companyData = getCompanyData();
        return view('frontend.normatividad')->with(compact('normativities', 'companyData', 'sections', 'categories'));
    }

    public function indexReassign(Request $request)
    {
        if (!empty($request->categoryId)) {
            $reasigns = Reassign::orderBy('fecha')->category($request->categoryId)->paginate(4);
            $reasigns->appends(['categoryId' => $request->categoryId]);
        } else if (!empty($request->search)) {
            $reasigns = Reassign::orderBy('fecha')->title($request->search)->paginate(4);
            $reasigns->appends(['search' => $request->search]);
        } else {
            $reasigns = Reassign::orderBy('fecha')->paginate(4);
        }
        $categories = DB::table('dx_reasi_categoria')->get(['id', 'titulo']);
        $sections = DB::table('dx_articulo_categoria')->where([['id', '<>', 5], ['id', '<>', 9]])->get(['id', 'titulo']);
        $sections->each(function ($section) {
            $section->articles =  Article::select('id', 'titulo')->where('idarticulo_categoria', $section->id)->get();
        });
        $companyData = getCompanyData();
        return view('frontend.reasignacion')->with(compact('reasigns', 'companyData', 'sections', 'categories'));
    }

    public function indexCharges(Request $request)
    {
        if (!empty($request->categoryId)) {
            $charges = Charge::orderBy('fecha')->category($request->categoryId)->paginate(4);
            $charges->appends(['categoryId' => $request->categoryId]);
        } else if (!empty($request->search)) {
            $charges = Charge::orderBy('fecha')->title($request->search)->paginate(4);
            $charges->appends(['search' => $request->search]);
        } else {
            $charges = Charge::orderBy('fecha')->paginate(4);
        }
        $categories = DB::table('dx_encargatura_categoria')->get(['id', 'titulo']);
        $sections = DB::table('dx_articulo_categoria')->where([['id', '<>', 5], ['id', '<>', 9]])->get(['id', 'titulo']);
        $sections->each(function ($section) {
            $section->articles =  Article::select('id', 'titulo')->where('idarticulo_categoria', $section->id)->get();
        });
        $companyData = getCompanyData();
        return view('frontend.encargaturas')->with(compact('charges', 'companyData', 'sections', 'categories'));
    }

    public function indexAnnouncements(Request $request)
    {
        $announcements = Announcements::get();
        $sections = DB::table('dx_articulo_categoria')->select('id', 'titulo')->where([['id', '<>', 5], ['id', '<>', 9]])->get();
        $sections->each(function ($section) {
            $section->articles =  Article::select('id', 'titulo')->where('idarticulo_categoria', $section->id)->get();
        });
        $companyData = getCompanyData();
        return view('frontend.announcements')->with(compact('announcements', 'companyData', 'sections'));
    }

    public function indexContract(Request $request)
    {
        if (!empty($request->categoryId)) {
            $contracts = Contract::orderBy('fecha')->category($request->categoryId)->paginate(4);
            $contracts->appends(['categoryId' => $request->categoryId]);
        } else if (!empty($request->search)) {
            $contracts = Contract::orderBy('fecha')->title($request->search)->paginate(4);
            $contracts->appends(['search' => $request->search]);
        } else {
            $contracts = Contract::orderBy('fecha')->paginate(4);
        }
        $categories = DB::table('dx_contrato_categoria')->get(['id', 'titulo']);
        $sections = DB::table('dx_articulo_categoria')->select('id', 'titulo')->where([['id', '<>', 5], ['id', '<>', 9]])->get();
        $sections->each(function ($section) {
            $section->articles =  Article::select('id', 'titulo')->where('idarticulo_categoria', $section->id)->get();
        });
        $companyData = getCompanyData();
        return view('frontend.contratos')->with(compact('contracts', 'categories', 'companyData', 'sections'));
    }


    public function announcementDetail($id)
    {
        $announcementDetail = Announcements::where('id', $id)->first();
        $sections = DB::table('dx_articulo_categoria')->select('id', 'titulo')->where([['id', '<>', 5], ['id', '<>', 9]])->get();
        $sections->each(function ($section) {
            $section->articles =  Article::select('id', 'titulo')->where('idarticulo_categoria', $section->id)->get();
        });
        $files = $this->mediaCollection;
        $companyData = getCompanyData();
        return view('frontend.announcement_detail')->with(compact('announcementDetail', 'companyData', 'sections', 'files'));
    }

    public function articleDetail($id)
    {
        $articleDetail = Article::where('id', $id)->first();
        $sections = DB::table('dx_articulo_categoria')->select('id', 'titulo')->where([['id', '<>', 5], ['id', '<>', 9]])->get();
        $sections->each(function ($section) {
            $section->articles =  Article::select('id', 'titulo')->where('idarticulo_categoria', $section->id)->get();
        });
        $companyData = getCompanyData();
        return view('frontend.article_detail')->with(compact('articleDetail', 'companyData', 'sections'));
    }
}
