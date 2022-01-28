<?php

namespace App\Http\Controllers;

use App\Article;
use App\Section;
use App\Documents;
use App\Partner;
use Illuminate\Http\Request;


class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companyData = getCompanyData();
        $sections = Section::where([['id', '<>', 5], ['id', '<>', 6], ['id', '<>', 7]])->get();
        $partners = Partner::get();
        $links = Article::where('section_id', 7)->get();
        $collection = collect($links);
        $linksArray = $collection;
        $linksArray->toArray();
        $articles = Article::where('section_id', 6)->take(3)->get();
        $regulations = Documents::where('category_id', 3)->latest()->take(3)->get();
        $announcements = Documents::where('category_id', 2)->latest()->take(3)->get();
        $slider = Article::where('section_id', 5)->orderBy('order')->get();
        return view('frontend.home')->with([
            'companyData' => $companyData, 'sections' => $sections, 'partners' => $partners, 'linksArray' => $linksArray, 'sliders' => $slider, 'articles' => $articles, 'announcements' => $announcements, 'regulations' => $regulations
        ]);
    }

    public function indexDocuments()
    {
        $documents = Documents::where('category_id', 1)->latest()->paginate(4);
        $sections = Section::where([['id', '<>', 5], ['id', '<>', 6], ['id', '<>', 7]])->get();
        $companyData = getCompanyData();
        return view('frontend.documents')->with(compact('documents', 'companyData', 'sections'));
    }

    public function indexAnnouncements()
    {
        $announcements = Documents::where('category_id', 2)->get();
        $sections = Section::where([['id', '<>', 5], ['id', '<>', 6], ['id', '<>', 7]])->get();
        $companyData = getCompanyData();
        return view('frontend.announcements')->with(compact('announcements', 'companyData', 'sections'));
    }

    public function indexContact()
    {
        $sections = Section::where([['id', '<>', 5], ['id', '<>', 6], ['id', '<>', 7]])->get();
        $companyData = getCompanyData();
        return view('frontend.contact')->with(compact('companyData', 'sections'));
    }

    public function indexArticles(Request $request)
    {
        $search = $request->get('search');
        $articles = Article::where('section_id', 6)->latest()->title($search)->paginate(4);
        $sections = Section::where([['id', '<>', 5], ['id', '<>', 6], ['id', '<>', 7]])->get();
        $companyData = getCompanyData();
        return view('frontend.noticias')->with(compact('companyData', 'articles', 'sections'));
    }

    public function indexNormativity()
    {
        $regulations = Documents::where('category_id', 3)->latest()->paginate(4);
        $sections = Section::where([['id', '<>', 5], ['id', '<>', 6], ['id', '<>', 7]])->get();
        $companyData = getCompanyData();
        return view('frontend.normatividad')->with(compact('regulations', 'companyData', 'sections'));
    }

    public function articleDetail($slug)
    {
        $articleDetail = Article::where('slug', $slug)->first();
        $sections = Section::where([['id', '<>', 5], ['id', '<>', 6], ['id', '<>', 7]])->get();
        $companyData = getCompanyData();
        return view('frontend.article_detail')->with(compact('articleDetail', 'companyData', 'sections'));
    }

    public function findArticles(Request $request)
    {
        $search = $request->get('search');
        $articles = Article::where('section_id', 6)->title($search)->paginate(4);
        $sections = Section::where([['id', '<>', 5], ['id', '<>', 6], ['id', '<>', 7]])->get();
        $companyData = getCompanyData();
        if ($articles->total() === 0) {
            return view('frontend.404')->with(compact('companyData', 'sections'));
        }
        return view('frontend.search_result')->with(compact('articles', 'companyData', 'sections'));
    }
}
