<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'Auth\AuthController@login');
Route::post('register', 'Auth\AuthController@register');

Route::get('home', 'Auth\AuthController@home');
Route::get('sections/{slugSection}/articles', 'Auth\AuthController@getArticlesBySections');
Route::get('article/{idArticle}', 'Auth\AuthController@getArticleDetail');
Route::get('/sections', 'Auth\AuthController@getSections');
Route::get('/banner', 'Auth\AuthController@getSlide');
Route::get('/areas', 'Auth\AuthController@getAreas');
Route::get('/company/public', 'Auth\AuthController@getCompanyData');
Route::get('/section/{slugSection}', 'Auth\AuthController@getSectionDetail');

Route::get('activation/{data}/{content}', 'Auth\AuthController@activate');
Route::post('forget-password', 'Auth\AuthController@sendLinkResetPassword');
Route::post('reset-password', 'Auth\AuthController@ResetPassword');


Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('user-register-course', 'Api\CourseController@UserRegisterOnCourse');
    Route::post('logout', 'Auth\AuthController@logout');
    Route::get('current', 'Auth\AuthController@getUserDetails');
    Route::get('certificate/{id}/course/download', 'Api\CourseController@downloadPdf');
    Route::get('courses', 'Api\CourseController@index');
    Route::get('courses/{id}/detail', 'Api\CourseController@detailCourseByUser');

    Route::get('courses/{id}/units', 'Api\CourseController@unitsByCourse');
    Route::get('units', 'Api\UnitController@index');
    Route::get('units/{id}/questions', 'Api\UnitController@questionsByUnit');
    Route::get('questions', 'Api\QuestionController@index');
    Route::get('questions/{id}/answers', 'Api\QuestionController@index');
    //RUTA PARA FINALIZAR EL CURSO
    Route::post('units/{id}/final','Api\UnitController@finishUnit');
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




