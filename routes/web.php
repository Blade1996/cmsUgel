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

        //Slider
        Route::get('dashboard/slider', 'SliderController@index')->name('dashboard.slider.index');
        Route::match(['get', 'post'], 'dashboard/slider/create', 'SliderController@addSlider')->name('dashboard.slider');
        Route::match(['get', 'post'], 'dashboard/slider/edit/{id?}', 'SliderController@editSlider')->name('dashboard.slider.edit');
        Route::post('dashboard/slider/upd-slider-order', 'SliderController@updateOrder')->name('dashboard.slider.upd-order');
        Route::get('dashboard/slider/delete/{id}', 'SliderController@deleteSlider')->name('dashboard.slider.delete');

        //Articles
        Route::get('dashboard/articles', 'ArticleController@index')->name('dashboard.articles.index');
        Route::match(['get', 'post'], 'dashboard/articles/create', 'ArticleController@addArticle')->name('dashboard.articles.create');
        Route::match(['get', 'post'], 'dashboard/articles/edit/{id?}', 'ArticleController@editArticle')->name('dashboard.articles.edit');
        Route::get('dashboard/article/delete/{id}', 'ArticleController@deleteArticle')->name('dashboard.articles.delete');
        Route::get('dashboard/articles/section/{id}', 'SectionController@sectionDetails');


        //Areas
        Route::get('dashboard/areas', 'AreasController@index')->name('dashboard.areas.index');
        Route::match(['get', 'post'], 'dashboard/area/create', 'AreasController@addArea')->name('dashboard.areas.create');
        Route::match(['get', 'post'], 'dashboard/area/edit/{id?}', 'AreasController@editArea')->name('dashboard.areas.edit');
        Route::get('dashboard/area/delete/{id}', 'AreasController@deleteArea')->name('dashboard.areas.delete');

        //InterestLinks
        Route::get('dashboard/interest-links', 'InterestLinkController@index')->name('dashboard.links.index');
        Route::match(['get', 'post'], 'dashboard/interest-links/create', 'InterestLinkController@addLink')->name('dashboard.links.create');
        Route::match(['get', 'post'], 'dashboard/interest-links/edit/{id?}', 'InterestLinkController@editLink')->name('dashboard.links.edit');
        Route::get('dashboard/interest-links/delete/{id}', 'InterestLinkController@deleteLink')->name('dashboard.links.delete');

        //Documents
        Route::get('dashboard/documents', 'DocumentController@index')->name('dashboard.documents.index');
        Route::match(['get', 'post'], 'dashboard/documents/create/{slug?}', 'DocumentController@addDocument')->name('dashboard.documents.create');
        Route::match(['get', 'post'], 'dashboard/documents/edit/{id?}', 'DocumentController@editDocument')->name('dashboard.documents.edit');
        Route::get('dashboard/documents/delete/{id}', 'DocumentController@deleteDocument')->name('dashboard.documents.delete');
        Route::get('dashboard/announcements', 'DocumentController@announcements')->name('dashboard.announcements.index');
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

        //Course
        Route::resource('dashboard/courses', 'CourseController');
        Route::get('dashboard/courses-users', 'CourseController@CoursesByUser');
        Route::get('dashboard/courses-detail-course/{id}', 'CourseController@getTemplateDetailCourse');
        Route::delete('dashboard/user-courses/{id}/delete', 'CourseController@deleteUserCourse');
        Route::get('dashboard/course/{course_id}/user/{id}/units', 'CourseController@getUnitsCourseByUser');
        Route::patch('dashboard/courses/{id}/status', 'CourseController@changeStatus');
        Route::get('certificate/{id}/course/download', 'CourseController@downloadPdf');
        Route::get('dashboard/list-units/{id}/modal/course', 'CourseController@getModalUnitsByCourse');
        //Unit
        Route::resource('dashboard/units', 'UnitController');
        Route::patch('dashboard/units/{id}/status', 'UnitController@changeStatus');
        Route::delete('dashboard/units/{id}/delete/file', 'UnitController@deleteImageUnit');
        Route::get('dashboard/list-questions-units/{id}', 'UnitController@getTableQuestionsByUnit');
        Route::get('dashboard/list-units/{id}/course', 'UnitController@getTableUnitsByCourse');
        Route::post('dashboard/units/order', 'UnitController@unitOrderUpdate');
        //Question
        Route::resource('dashboard/questions', 'QuestionController');
        Route::patch('dashboard/questions/{id}/status', 'QuestionController@changeStatus');

        //TypeAnswers
        Route::resource('dashboard/type-answers', 'TypeAnswerController');
        //Users
        Route::resource('dashboard/users', 'UserController');
        Route::patch('dashboard/users/{id}/status', 'UserController@changeStatus');
        //TypeAnswersQuestions
        Route::resource('dashboard/type-answers-questions', 'TypeAnswerQuestionController');
        Route::get('dashboard/list-answers-questions/{id}', 'TypeAnswerQuestionController@show');
        Route::patch('dashboard/validated-answers-questions/{id}', 'TypeAnswerQuestionController@changeValid');
        Route::patch('dashboard/status-answers-questions/{id}', 'TypeAnswerQuestionController@changeStatus');
        Route::get('dashboard/answers-questions/{id}/edit', 'TypeAnswerQuestionController@edit');
        Route::put('dashboard/answers-questions/{id}', 'TypeAnswerQuestionController@update');
        Route::delete('dashboard/answers-questions/{id}/delete', 'TypeAnswerQuestionController@destroy');
    });
});
