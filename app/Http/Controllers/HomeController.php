<?php

namespace App\Http\Controllers;

use App\Article;
use App\Section;
use App\Documents;
use App\Announcement;
use App\InterestLink;
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
        $links = Article::where('section_id', 7)->get();
        $collection = collect($links);
        $linksArray = $collection;
        $linksArray->toArray();
        $articles = Article::where('section_id', 6)->take(3)->get();
        $documents = Documents::latest()->take(3)->get();
        $announcements = Announcement::latest()->take(3)->get();
        $slider = Article::where('section_id', 5)->orderBy('order')->get();
        return view('frontend.home')->with(['companyData' => $companyData, 'sections' => $sections, 'linksArray' => $linksArray, 'sliders' => $slider, 'articles' => $articles, 'documents' => $documents, 'announcements' => $announcements]);
    }

    public function indexDocuments()
    {
        $documents = Documents::get();
        $sections = Section::where([['id', '<>', 5], ['id', '<>', 6], ['id', '<>', 7]])->get();
        $companyData = getCompanyData();
        return view('frontend.documents')->with(compact('documents', 'companyData', 'sections'));
    }

    public function indexAnnouncements()
    {
        $announcements = Announcement::get();
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

    public function indexArticles()
    {
        Article::where('section_id', 6)->paginate(4);
        $sections = Section::where([['id', '<>', 5], ['id', '<>', 6], ['id', '<>', 7]])->get();
        $companyData = getCompanyData();
        return view('frontend.noticias')->with(compact('companyData', 'articles', 'sections'));
    }

    public function indexNormativity()
    {
        $documents = Documents::paginate(4);
        $sections = Section::where([['id', '<>', 5], ['id', '<>', 6], ['id', '<>', 7]])->get();
        $companyData = getCompanyData();
        return view('frontend.normatividad')->with(compact('documents', 'companyData', 'sections'));
    }

    public function articleDetail($slug)
    {
        $articleDetail = Article::where('slug', $slug)->first();
        $sections = Section::where([['id', '<>', 5], ['id', '<>', 6], ['id', '<>', 7]])->get();
        $companyData = getCompanyData();
        return view('frontend.article_detail')->with(compact('articleDetail', 'companyData', 'sections'));
    }
}
