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

});
Route::post('login','Api\UserController@login')->name('login');
Route::post('registerclient','Api\UserController@registerclient')->name('registerclient');

