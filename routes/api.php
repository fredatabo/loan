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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//file upload without AUTH


Route::post('uploadPhoto/{id}', 'FileuploadController@uploadPhotoWithoutAuth');
Route::post('register', 'PassportAuthController@register');
Route::post('login', 'PassportAuthController@login');

Route::post('loginSuperAdminAndEs', 'PassportAuthController@loginSuperAdminAndEs');
Route::post('login', 'PassportAuthController@login');
//Route::post('mailTo', 'PassportAuthController@new_mail');
Route::get('signup/activate/{token}', 'PassportAuthController@signupActivate');

Route::post('updatePaymentRecord/{id}', 'PassportAuthController@updatePaymentRecord');
Route::post('resetPassword', 'PassportAuthController@resetPassword');
Route::get('getAllApplicant1', 'EsController@getAllApplicantsWithoutAuth');

Route::get('getCielingByLevel/{level}', 'LoanController@getCielingByLevel');




 
Route::get('userInfo/{id}', 'PersonalInfoController@getUserByIdWithoutAuth');
Route::middleware('auth:api')->group(function () {
    Route::resource('posts', 'PostController');
});

// routes to get user by id
/** 
Route::middleware('auth:api')->group(function () {
    
});
*/

Route::middleware('auth:api')->group(function () {
    Route::get('getUser/{id}', 'PersonalInfoController@getUserById');
   // Route::put('updateUser/{id}', 'PersonalInfoController@update');
    Route::resource('getUser1', 'PersonalInfoController');
    Route::post('logout', 'PassportAuthController@logout');
    Route::put('updateBioData/{id}', 'PersonalInfoController@updateBioData');
    
    Route::put('submitToEs/{id}', 'PersonalInfoController@submitToEs');
    Route::put('updateAppointmentRecord/{id}', 'PersonalInfoController@updateAppointmentInformation');
    //documents upload route
    //Route::put('uploadPassport/{id}', 'FileuploadController@uploadPhoto');
    Route::put('uploadAppointmentLetter/{id}', 'FileuploadController@uploadLetterAppointment');
    Route::put('uploadPayslip/{id}', 'FileuploadController@uploadPaySlip');
    Route::put('uploaduploadGazzette/{id}', 'FileuploadController@uploadGazzette');
    Route::put('uploadSurety/{id}', 'FileuploadController@uploadSurety');
    Route::put('uploadReason/{id}', 'FileuploadController@uploadReason');

    //registerEs

    //other routes requiring auth
    Route::get('getCielings', 'LoanController@getCielings');
    
    
    
});

Route::post('uploadPassport/{id}', 'FileuploadController@uploadPhoto');
//super admin routes




Route::middleware('auth:api')->group(function () {
    // add new es
    Route::post('addEsRole', 'PassportAuthController@registerEs');
    Route::post('deleteEs/{id}', 'SuperAdminController@deleteEs');
    Route::get('allEsRecords', 'SuperAdminController@getAllEs');
    Route::get('getEsRecord/{id}', 'SuperAdminController@getEsRecordById');
    Route::post('updateEsRecord/{id}', 'SuperAdminController@updateEsRecord');
});

//ES ROUTES

Route::middleware('auth:api')->group(function () {
    // add new es
    Route::get('getAllApplicants', 'EsController@getAllApplicants');
    Route::get('getAllApplicantsPending', 'EsController@getAllApplicantsPending');
    Route::get('getApplicantRecordById/{id}', 'EsController@getApplicantRecordById');
    Route::put('verifyRecords/{id}', 'EsController@verifyRecords');
});
