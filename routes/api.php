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



route::group(['middleware'=>['auth:api'],'namespace'=>'Api'],function(){


    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::post('users/delete','UserController@deleteAll');
    Route::get('/verify', 'UserController@verify');
    Route::resource('design','DesignController');
    Route::post('email/verify', 'UserController@verifyEmail');
    Route::post('roles/delete', 'RoleController@deleteAll');
    Route::post('user/role', 'UserController@changeRole');
    Route::post('user/photo', 'UserController@changePhoto');
 
});
Route::post('login','Api\UserController@login')->name('login');
Route::post('clientlogin','Api\UserController@clientlogin')->name('clientlogin');
Route::post('registerclient','Api\UserController@registerclient')->name('registerclient');
Route::post('resetpassword','Api\UserController@resetpassword')->name('resetpassword');
Route::post('resetsetpassword','Api\UserController@resetsetpassword')->name('resetsetpassword');

