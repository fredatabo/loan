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

Route::post('register', 'PassportAuthController@register');
Route::post('login', 'PassportAuthController@login');
//Route::post('mailTo', 'PassportAuthController@new_mail');
Route::get('signup/activate/{token}', 'PassportAuthController@signupActivate');

Route::post('resetPassword', 'PassportAuthController@resetPassword');
 
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
    
    Route::put('updateAppointmentRecord/{id}', 'PersonalInfoController@updateAppointmentInformation');
    
});