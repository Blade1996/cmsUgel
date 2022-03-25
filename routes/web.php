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
Route::get('/reasignacion', 'HomeController@indexReassign')->name('home.reassign');
Route::get('/contratos', 'HomeController@indexContract')->name('home.contract');
Route::get('/encargaturas', 'HomeController@indexCharges')->name('home.charges');
Route::get('/normatividad/category/{id}', 'HomeController@indexNormativity')->name('home.normativity.category');
Route::get('/reasignacion/category/{id}', 'HomeController@indexReassign')->name('home.reassign.category');
Route::get('/contratos/category/{id}', 'HomeController@indexContract')->name('home.contract.category');
Route::get('/encargaturas/category/{id}', 'HomeController@indexCharges')->name('home.charges.category');
Route::get('/articulo/{id}', 'HomeController@articleDetail')->name('home.article.detail');
Route::get('/convocatoria/{id}', 'HomeController@announcementDetail')->name('home.announcement.detail');
Route::get('/articulos', 'HomeController@findArticles')->name('home.articles.find');
Route::get('/document/find', 'HomeController@findDocument')->name('home.document.find');





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
        Route::get('dashboard/section/delete/{id}', 'SectionController@destroy')->name('dashboard.section.delete');

        //Partners
        Route::get('dashboard/partners', 'PartnerController@listPartners')->name('dashboard.partners');
        Route::post('dashboard/upd-partner-status', 'PartnerController@updatePartnerStatus')->name('dashboard.upd-partner-status');
        Route::match(['get', 'post'], 'dashboard/partners/create', 'PartnerController@addPartner')->name('dashboard.partner.create');
        Route::match(['get', 'post'], 'dashboard/partners/edit/{id?}', 'PartnerController@editPartner')->name('dashboard.partner.edit');
        Route::get('dashboard/partners/delete/{id}', 'PartnerController@destroy')->name('dashboard.partner.delete');

        //Slider
        Route::get('dashboard/slider', 'SliderController@index')->name('dashboard.slider.index');
        Route::post('dashboard/upd-slider-status', 'SliderController@updateSliderStatus')->name('dashboard.upd-slider-status');
        Route::match(['get', 'post'], 'dashboard/slider/create', 'SliderController@addSlider')->name('dashboard.slider.create');
        Route::match(['get', 'post'], 'dashboard/slider/edit/{id?}', 'SliderController@editSlider')->name('dashboard.slider.edit');
        Route::post('dashboard/slider/upd-slider-order', 'SliderController@updateOrder')->name('dashboard.slider.upd-order');
        Route::get('dashboard/slider/delete/{id}', 'SliderController@destroy')->name('dashboard.slider.delete');

        //Articles
        Route::get('dashboard/articles', 'ArticleController@index')->name('dashboard.articles.index');
        Route::match(['get', 'post'], 'dashboard/articles/create', 'ArticleController@addArticle')->name('dashboard.articles.create');
        Route::post('dashboard/upd-article-status', 'ArticleController@updateArticleStatus')->name('dashboard.upd-article-status');
        Route::match(['get', 'post'], 'dashboard/articles/edit/{id?}', 'ArticleController@editArticle')->name('dashboard.articles.edit');
        Route::get('dashboard/article/delete/{id}', 'ArticleController@destroy')->name('dashboard.articles.delete');
        Route::get('dashboard/articles/section/{id}', 'SectionController@sectionDetails');

        //Advertisements
        Route::get('dashboard/advertisements', 'AdvertisementsController@index')->name('dashboard.advertisements.index');
        Route::post('dashboard/upd-advertisement-status', 'AdvertisementsController@updateAdvertisementStatus')->name('dashboard.upd-advertisements-status');
        Route::match(['get', 'post'], 'dashboard/advertisements/create', 'AdvertisementsController@add')->name('dashboard.advertisements.create');
        Route::match(['get', 'post'], 'dashboard/advertisements/edit/{id?}', 'AdvertisementsController@edit')->name('dashboard.advertisements.edit');
        Route::get('dashboard/advertisements/delete/{id}', 'AdvertisementsController@destroy')->name('dashboard.advertisements.delete');

        //Advertising
        Route::get('dashboard/advertising', 'AdvertisingController@index')->name('dashboard.advertising.index');
        Route::post('dashboard/upd-advertising-status', 'AdvertisingController@updateAdvertisingStatus')->name('dashboard.upd-advertising-status');
        Route::match(['get', 'post'], 'dashboard/advertising/create', 'AdvertisingController@add')->name('dashboard.advertising.create');
        Route::match(['get', 'post'], 'dashboard/advertising/edit/{id?}', 'AdvertisingController@edit')->name('dashboard.advertising.edit');
        Route::get('dashboard/advertising/delete/{id}', 'AdvertisingController@destroy')->name('dashboard.advertising.delete');

        //Normativity
        Route::get('dashboard/normativities', 'NormativityController@index')->name('dashboard.normativity.index');
        Route::post('dashboard/upd-normativity-status', 'NormativityController@updateNormativityStatus')->name('dashboard.upd-normativity-status');
        Route::match(['get', 'post'], 'dashboard/normativities/create', 'NormativityController@add')->name('dashboard.normativity.create');
        Route::match(['get', 'post'], 'dashboard/normativities/edit/{id?}', 'NormativityController@edit')->name('dashboard.normativity.edit');
        Route::get('dashboard/normativities/delete/{id}', 'NormativityController@destroy')->name('dashboard.normativity.delete');

        //Announcements
        Route::get('dashboard/announcement', 'AnnouncementController@index')->name('dashboard.announcement.index');
        Route::post('dashboard/upd-announcement-status', 'AnnouncementController@updateAnnouncementStatus')->name('dashboard.upd-announcement-status');
        Route::match(['get', 'post'], 'dashboard/announcement/create', 'AnnouncementController@add')->name('dashboard.announcement.create');
        Route::match(['get', 'post'], 'dashboard/announcement/edit/{id?}', 'AnnouncementController@edit')->name('dashboard.announcement.edit');
        Route::get('dashboard/announcement/delete/{id}', 'AnnouncementController@destroy')->name('dashboard.announcement.delete');

        /*    //Desk
        Route::get('dashboard/desk', 'DeskController@index')->name('dashboard.desk.index');
        Route::match(['get', 'post'], 'dashboard/announcement/create', 'DeskController@add')->name('dashboard.announcement.create'); */

        //Auxiliar
        Route::get('dashboard/auxiliar', 'AuxiliarController@index')->name('dashboard.auxiliar.index');
        Route::post('dashboard/upd-auxiliar-status', 'AuxiliarController@updateAuxiliarStatus')->name('dashboard.upd-auxiliar-status');
        Route::match(['get', 'post'], 'dashboard/auxiliar/create', 'AuxiliarController@add')->name('dashboard.auxiliar.create');
        Route::match(['get', 'post'], 'dashboard/auxiliar/edit/{id?}', 'AuxiliarController@edit')->name('dashboard.auxiliar.edit');
        Route::get('dashboard/auxiliar/delete/{id}', 'AuxiliarController@destroy')->name('dashboard.auxiliar.delete');

        //Covid
        Route::get('dashboard/covid', 'CovidController@index')->name('dashboard.covid.index');
        Route::post('dashboard/upd-covid-status', 'CovidController@updateCovidStatus')->name('dashboard.upd-covid-status');
        Route::match(['get', 'post'], 'dashboard/covid/create', 'CovidController@add')->name('dashboard.covid.create');
        Route::match(['get', 'post'], 'dashboard/covid/edit/{id?}', 'CovidController@edit')->name('dashboard.covid.edit');
        Route::get('dashboard/covid/delete/{id}', 'CovidController@destroy')->name('dashboard.covid.delete');

        //Control
        Route::get('dashboard/control', 'ControlController@index')->name('dashboard.control.index');
        Route::post('dashboard/upd-control-status', 'ControlController@updateControlStatus')->name('dashboard.upd-control-status');
        Route::match(['get', 'post'], 'dashboard/control/create', 'ControlController@add')->name('dashboard.control.create');
        Route::match(['get', 'post'], 'dashboard/control/edit/{id?}', 'ControlController@edit')->name('dashboard.control.edit');
        Route::get('dashboard/control/delete/{id}', 'ControlController@destroy')->name('dashboard.control.delete');


        //Contract
        Route::get('dashboard/contract', 'ContractController@index')->name('dashboard.contract.index');
        Route::post('dashboard/upd-contract-status', 'ContractController@updateContractStatus')->name('dashboard.upd-contract-status');
        Route::match(['get', 'post'], 'dashboard/contract/create', 'ContractController@add')->name('dashboard.contract.create');
        Route::match(['get', 'post'], 'dashboard/contract/edit/{id?}', 'ContractController@edit')->name('dashboard.contract.edit');
        Route::get('dashboard/contract/delete/{id}', 'ContractController@destroy')->name('dashboard.announcement.delete');

        //Interest Links
        Route::get('dashboard/link', 'InterestLinkController@index')->name('dashboard.link.index');
        Route::post('dashboard/upd-link-status', 'InterestLinkController@updateLinkStatus')->name('dashboard.upd-link-status');
        Route::match(['get', 'post'], 'dashboard/link/create', 'InterestLinkController@add')->name('dashboard.link.create');
        Route::match(['get', 'post'], 'dashboard/link/edit/{id?}', 'InterestLinkController@edit')->name('dashboard.link.edit');
        Route::get('dashboard/link/delete/{id}', 'InterestLinkController@destroy')->name('dashboard.link.delete');


        //rotate
        Route::get('dashboard/rotate', 'RotateController@index')->name('dashboard.rotate.index');
        Route::post('dashboard/upd-rotate-status', 'RotateController@updateRotateStatus')->name('dashboard.upd-rotate-status');
        Route::match(['get', 'post'], 'dashboard/rotate/create', 'RotateController@add')->name('dashboard.rotate.create');
        Route::match(['get', 'post'], 'dashboard/rotate/edit/{id?}', 'RotateController@edit')->name('dashboard.rotate.edit');
        Route::get('dashboard/announcement/delete/{id}', 'AnnouncementController@destroy')->name('dashboard.rotate.delete');

        //election
        Route::get('dashboard/election', 'ElectionController@index')->name('dashboard.election.index');
        Route::post('dashboard/upd-election-status', 'ElectionController@updateElectionStatus')->name('dashboard.upd-election-status');
        Route::match(['get', 'post'], 'dashboard/election/create', 'ElectionController@add')->name('dashboard.election.create');
        Route::match(['get', 'post'], 'dashboard/election/edit/{id?}', 'ElectionController@edit')->name('dashboard.election.edit');
        Route::get('dashboard/election/delete/{id}', 'ElectionController@destroy')->name('dashboard.election.delete');


        //charge
        Route::get('dashboard/charge', 'ChargeController@index')->name('dashboard.charge.index');
        Route::post('dashboard/upd-charge-status', 'ChargeController@updateChargeStatus')->name('dashboard.upd-charge-status');
        Route::match(['get', 'post'], 'dashboard/charge/create', 'ChargeController@add')->name('dashboard.charge.create');
        Route::match(['get', 'post'], 'dashboard/charge/edit/{id?}', 'ChargeController@edit')->name('dashboard.charge.edit');
        Route::get('dashboard/charge/delete/{id}', 'ChargeController@destroy')->name('dashboard.charge.delete');


        //reassign
        Route::get('dashboard/reassign', 'ReassignController@index')->name('dashboard.reassign.index');
        Route::post('dashboard/upd-reassign-status', 'ReassignController@updateReassignStatus')->name('dashboard.upd-reassign-status');
        Route::match(['get', 'post'], 'dashboard/reassing/create', 'ReassignController@add')->name('dashboard.reassign.create');
        Route::match(['get', 'post'], 'dashboard/reassing/edit/{id?}', 'ReassignController@edit')->name('dashboard.reassign.edit');
        Route::get('dashboard/reassing/delete/{id}', 'ReassignController@destroy')->name('dashboard.reassign.delete');

        //DocumentsFiles
        Route::post('file-upload/{slug?}', 'AnnouncementController@storeMedia')->name('announcement.storeMedia');

        Route::post('files-upload', 'DocumentController@storeMedia2')->name('documents.storeFiles');

        //Documents
        Route::get('dashboard/documents', 'DocumentController@index')->name('dashboard.documents.index');
        // Route::post('dashboard/upd-article-status', 'SectionController@updateArticleStatus')->name('dashboard.upd-article-status');
        Route::match(['get', 'post'], 'dashboard/documents/create/{slug?}', 'DocumentController@addDocument')->name('dashboard.documents.create');
        Route::match(['get', 'post'], 'dashboard/documents/edit/{id?}', 'DocumentController@editDocument')->name('dashboard.documents.edit');
        Route::get('dashboard/documents/delete/{id}', 'DocumentController@destroy')->name('dashboard.documents.delete');
        Route::get('dashboard/regulations', 'DocumentController@regulations')->name('dashboard.regulations.index');

        //DocumentTree
        Route::get('dashboard/document-tree', 'DocumentTreeController@manageDocuments')->name('dashboard.document-tree.index');
        Route::match(['get', 'post'], 'dashboard/document-tree/create/{id?}', 'DocumentTreeController@addTree')->name('dashboard.add-category');
        Route::match(['get', 'post'], 'dashboard/document-tree/edit/{id?}', 'DocumentTreeController@editTree')->name('dashboard.edit-category');
        Route::get('dashboard/head/{id}', 'DocumentTreeController@getDataNode')->name('dashboard.getDataNode');
        Route::post('dashboard/edit/tree/{id}/header', 'DocumentTreeController@editHeader')->name('dashboard.edit-tree-header');
        Route::post('dashboard/edit/tree/{id}/node', 'DocumentTreeController@editNode')->name('dashboard.edit-tree-node');
        Route::post('document-tree/files-upload', 'DocumentTreeController@storeToTree')->name('document-tree.storeFiles');
        Route::get('dashboard/tree/delete/{id}', 'DocumentTreeController@destroy')->name('dashboard.charge.delete');

        //Category
        Route::get('dashboard/categories', 'CategoryController@index')->name('dashboard.categories.index');
        // Route::post('dashboard/upd-article-status', 'SectionController@updateArticleStatus')->name('dashboard.upd-article-status');
        Route::match(['get', 'post'], 'dashboard/categories/create', 'CategoryController@addCategory')->name('dashboard.categories.create');
        Route::match(['get', 'post'], 'dashboard/categories/edit/{id?}', 'CategoryController@editCategory')->name('dashboard.categories.edit');
        Route::get('dashboard/categories/delete/{id}', 'CategoryController@destroy')->name('dashboard.categories.delete');

        //Sub Menus
        Route::get('dashboard/sub-categories', 'SubCategoryController@index')->name('dashboard.subcategories.index');
        // Route::post('dashboard/upd-article-status', 'SectionController@updateArticleStatus')->name('dashboard.upd-article-status');
        Route::match(['get', 'post'], 'dashboard/sub-categories/create', 'SubCategoryController@addSubCategory')->name('dashboard.subcategories.create');
        Route::match(['get', 'post'], 'dashboard/sub-categories/edit/{id?}', 'SubCategoryController@editSubCategory')->name('dashboard.subcategories.edit');
        Route::get('dashboard/sub-categories/delete/{id}', 'SubCategoryController@destroy')->name('dashboard.subcategories.delete');

        //helpCenter
        Route::match(['get', 'post'], 'dashboard/company', 'CompanyController@index')->name('dashboard.company');
        Route::match(['get', 'post'], 'dashboard/policies/{name?}', 'CompanyController@policies')->name('dashboard.policies');
        // Route::match(['get', 'post'], 'dashboard/helpcenter', 'CompanyController@addArea')->name('dashboard.help-center');
    });
});
