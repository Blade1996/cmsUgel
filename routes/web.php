<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/documentos', 'HomeController@indexDocuments')->name('home.document');
Route::get('/convocatorias', 'HomeController@indexAnnouncements')->name('home.announcements');
Route::get('/contacto', 'HomeController@indexContact')->name('home.contact');

Route::get('/noticias', 'HomeController@indexArticles')->name('home.articles');
Route::get('/normatividad', 'HomeController@indexNormativity')->name('home.normativity');
Route::get('/articulo/{slug}', 'HomeController@articleDetail')->name('home.article.detail');
Route::get('/convocatoria/{slug}', 'HomeController@announcementDetail')->name('home.announcement.detail');
Route::get('/articulos', 'HomeController@findArticles')->name('home.articles.find');





Route::prefix('admin')->namespace('Admin')->group(function () {

    // Route::method(url, controlador@metodo)

    Route::match(['get', 'post'], '/', 'AdminController@login')->name('admin.login')->middleware('guest:admin');

    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('dashboard/settings', 'AdminController@settings')->name('dashboard.settings');
        Route::get('logout', 'AdminController@logout')->name('dashboard.logout');
        Route::post('dashboard/verify-curr-pwd', 'AdminController@verifyPassword');
        Route::post('dashboard/update-pwd', 'AdminController@updatePassword')->name('dashboard.update-pwd');
        Route::match(['get', 'post'], 'dashboard/upd-admin-details', 'AdminController@updateAdminDetails')->name('dashboard.update-admin');

        //Sections
        Route::get('dashboard/sections', 'SectionController@index')->name('dashboard.sections');
        Route::post('dashboard/upd-section-status', 'SectionController@updateSectionStatus')->name('dashboard.upd-section-status');
        Route::match(['get', 'post'], 'dashboard/section/create', 'SectionController@addSection')->name('dashboard.section.create');
        Route::match(['get', 'post'], 'dashboard/section/edit/{id?}', 'SectionController@editSection')->name('dashboard.section.edit');
        Route::get('dashboard/section/delete/{id}', 'SectionController@deleteSection')->name('dashboard.section.delete');

        //Partners
        Route::get('dashboard/partners', 'PartnerController@listPartners')->name('dashboard.partners');
        // Route::post('dashboard/upd-section-status', 'SectionController@updateSectionStatus')->name('dashboard.upd-section-status');
        Route::match(['get', 'post'], 'dashboard/partners/create', 'PartnerController@addPartner')->name('dashboard.partner.create');
        Route::match(['get', 'post'], 'dashboard/partners/edit/{id?}', 'PartnerController@editPartner')->name('dashboard.partner.edit');
        Route::get('dashboard/partners/delete/{id}', 'PartnerController@deletePartner')->name('dashboard.partner.delete');

        //Slider
        Route::get('dashboard/slider', 'SliderController@index')->name('dashboard.slider.index');
        Route::match(['get', 'post'], 'dashboard/slider/create', 'SliderController@addSlider')->name('dashboard.slider.create');
        Route::match(['get', 'post'], 'dashboard/slider/edit/{id?}', 'SliderController@editSlider')->name('dashboard.slider.edit');
        Route::post('dashboard/slider/upd-slider-order', 'SliderController@updateOrder')->name('dashboard.slider.upd-order');
        Route::get('dashboard/slider/delete/{id}', 'SliderController@deleteSlider')->name('dashboard.slider.delete');

        //Articles
        Route::get('dashboard/articles', 'ArticleController@index')->name('dashboard.articles.index');
        Route::match(['get', 'post'], 'dashboard/articles/create', 'ArticleController@addArticle')->name('dashboard.articles.create');
        Route::match(['get', 'post'], 'dashboard/articles/edit/{id?}', 'ArticleController@editArticle')->name('dashboard.articles.edit');
        Route::get('dashboard/article/delete/{id}', 'ArticleController@deleteArticle')->name('dashboard.articles.delete');
        Route::get('dashboard/articles/section/{id}', 'SectionController@sectionDetails');

        //Advertisements
        Route::get('dashboard/advertisements', 'AdvertisementsController@index')->name('dashboard.advertisements.index');
        Route::match(['get', 'post'], 'dashboard/advertisements/create', 'AdvertisementsController@add')->name('dashboard.advertisements.create');
        Route::match(['get', 'post'], 'dashboard/advertisements/edit/{id?}', 'AdvertisementsController@edit')->name('dashboard.advertisements.edit');
        Route::get('dashboard/advertisements/delete/{id}', 'AdvertisementsController@deleteArticle')->name('dashboard.advertisements.delete');

        //Advertising
        Route::get('dashboard/advertising', 'AdvertisingController@index')->name('dashboard.advertising.index');
        Route::match(['get', 'post'], 'dashboard/advertising/create', 'AdvertisingController@add')->name('dashboard.advertising.create');
        Route::match(['get', 'post'], 'dashboard/advertising/edit/{id?}', 'AdvertisingController@edit')->name('dashboard.advertising.edit');
        Route::get('dashboard/advertising/delete/{id}', 'AdvertisingController@delete')->name('dashboard.advertising.delete');

        //Normativity
        Route::get('dashboard/normativities', 'NormativityController@index')->name('dashboard.normativity.index');
        Route::match(['get', 'post'], 'dashboard/normativities/create', 'NormativityController@add')->name('dashboard.normativity.create');
        Route::match(['get', 'post'], 'dashboard/normativities/edit/{id?}', 'NormativityController@edit')->name('dashboard.normativity.edit');
        Route::get('dashboard/normativities/delete/{id}', 'NormativityController@delete')->name('dashboard.normativity.delete');

        //Announcements
        Route::get('dashboard/announcement', 'AnnouncementController@index')->name('dashboard.announcement.index');
        Route::match(['get', 'post'], 'dashboard/announcement/create', 'AnnouncementController@add')->name('dashboard.announcement.create');
        Route::match(['get', 'post'], 'dashboard/announcement/edit/{id?}', 'AnnouncementController@edit')->name('dashboard.announcement.edit');
        Route::get('dashboard/announcement/delete/{id}', 'AnnouncementController@delete')->name('dashboard.announcement.delete');

        /*    //Desk
        Route::get('dashboard/desk', 'DeskController@index')->name('dashboard.desk.index');
        Route::match(['get', 'post'], 'dashboard/announcement/create', 'DeskController@add')->name('dashboard.announcement.create'); */

        //Auxiliar
        Route::get('dashboard/auxiliar', 'AuxiliarController@index')->name('dashboard.auxiliar.index');
        Route::match(['get', 'post'], 'dashboard/auxiliar/create', 'AuxiliarController@add')->name('dashboard.auxiliar.create');
        Route::match(['get', 'post'], 'dashboard/auxiliar/edit/{id?}', 'AuxiliarController@edit')->name('dashboard.auxiliar.edit');

        //Covid
        Route::get('dashboard/covid', 'CovidController@index')->name('dashboard.covid.index');
        Route::match(['get', 'post'], 'dashboard/covid/create', 'CovidController@add')->name('dashboard.covid.create');
        Route::match(['get', 'post'], 'dashboard/covid/edit/{id?}', 'CovidController@edit')->name('dashboard.covid.edit');


        //Control
        Route::get('dashboard/control', 'ControlController@index')->name('dashboard.control.index');
        Route::match(['get', 'post'], 'dashboard/control/create', 'ControlController@add')->name('dashboard.control.create');
        Route::match(['get', 'post'], 'dashboard/control/edit/{id?}', 'ControlController@edit')->name('dashboard.control.edit');

        //Contract
        Route::get('dashboard/contract', 'ContractController@index')->name('dashboard.contract.index');
        Route::match(['get', 'post'], 'dashboard/contract/create', 'ContractController@add')->name('dashboard.contract.create');
        Route::match(['get', 'post'], 'dashboard/contract/edit/{id?}', 'ContractController@edit')->name('dashboard.contract.edit');

        //rotate
        Route::get('dashboard/rotate', 'RotateController@index')->name('dashboard.rotate.index');
        Route::match(['get', 'post'], 'dashboard/rotate/create', 'RotateController@add')->name('dashboard.rotate.create');
        Route::match(['get', 'post'], 'dashboard/rotate/edit/{id?}', 'RotateController@edit')->name('dashboard.rotate.edit');

        //election
        Route::get('dashboard/election', 'ElectionController@index')->name('dashboard.election.index');
        Route::match(['get', 'post'], 'dashboard/election/create', 'ElectionController@add')->name('dashboard.election.create');
        Route::match(['get', 'post'], 'dashboard/election/edit/{id?}', 'ElectionController@edit')->name('dashboard.election.edit');

        //charge
        Route::get('dashboard/charge', 'ChargeController@index')->name('dashboard.charge.index');
        Route::match(['get', 'post'], 'dashboard/charge/create', 'ChargeController@add')->name('dashboard.charge.create');
        Route::match(['get', 'post'], 'dashboard/charge/edit/{id?}', 'ChargeController@edit')->name('dashboard.charge.edit');

        //reassign
        Route::get('dashboard/reassign', 'ReassignController@index')->name('dashboard.reassign.index');
        Route::match(['get', 'post'], 'dashboard/reassing/create', 'ReassignController@add')->name('dashboard.reassign.create');
        Route::match(['get', 'post'], 'dashboard/reassing/edit/{id?}', 'ReassignController@edit')->name('dashboard.reassign.edit');

        //DocumentsFiles
        Route::post('file-upload/{slug?}', 'DocumentController@storeMedia')->name('documents.storeMedia');

        //Documents
        Route::get('dashboard/documents', 'DocumentController@index')->name('dashboard.documents.index');
        Route::match(['get', 'post'], 'dashboard/documents/create/{slug?}', 'DocumentController@addDocument')->name('dashboard.documents.create');
        Route::match(['get', 'post'], 'dashboard/documents/edit/{id?}', 'DocumentController@editDocument')->name('dashboard.documents.edit');
        Route::get('dashboard/documents/delete/{id}', 'DocumentController@deleteDocument')->name('dashboard.documents.delete');
        Route::get('dashboard/regulations', 'DocumentController@regulations')->name('dashboard.regulations.index');

        //Category
        Route::get('dashboard/categories', 'CategoryController@index')->name('dashboard.categories.index');
        Route::match(['get', 'post'], 'dashboard/categories/create', 'CategoryController@addCategory')->name('dashboard.categories.create');
        Route::match(['get', 'post'], 'dashboard/categories/edit/{id?}', 'CategoryController@editCategory')->name('dashboard.categories.edit');
        Route::get('dashboard/categories/delete/{id}', 'CategoryController@deleteCategory')->name('dashboard.categories.delete');

        //Sub Menus
        Route::get('dashboard/sub-categories', 'SubCategoryController@index')->name('dashboard.subcategories.index');
        Route::match(['get', 'post'], 'dashboard/sub-categories/create', 'SubCategoryController@addSubCategory')->name('dashboard.subcategories.create');
        Route::match(['get', 'post'], 'dashboard/sub-categories/edit/{id?}', 'SubCategoryController@editSubCategory')->name('dashboard.subcategories.edit');
        Route::get('dashboard/sub-categories/delete/{id}', 'SubCategoryController@deleteSubCategory')->name('dashboard.subcategories.delete');

        //helpCenter
        Route::match(['get', 'post'], 'dashboard/company', 'CompanyController@index')->name('dashboard.company');
        Route::match(['get', 'post'], 'dashboard/policies/{name?}', 'CompanyController@policies')->name('dashboard.policies');
        // Route::match(['get', 'post'], 'dashboard/helpcenter', 'CompanyController@addArea')->name('dashboard.help-center');
    });
});
