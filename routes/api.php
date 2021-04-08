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
    Route::get('/verifyRole', 'UserController@verifyRole');
    Route::resource('design','DesignController');
   
    Route::post('users/savepersonalinfo','UserController@savepersonalinfo');
    Route::post('users/savebillinginfo','UserController@savebillinginfo');
    Route::post('users/getamount','UserController@getamount');
    Route::post('users/getBalance','UserController@getBalance');
    Route::post('users/savepassword','UserController@savepassword');
    Route::post('users/savepaymentinfo','UserController@savepaymentinfo');
    Route::post('design/downloadfile', 'DesignController@downloadfile');
    Route::post('design/sendremainder', 'DesignController@sendremainder');
    Route::post('design/getallawaitingquote', 'DesignController@getallawaitingquote');
    Route::post('design/viewquote', 'DesignController@viewquote');
    

    
    Route::resource('balancehistory','BalanceHistoryController');
    Route::post('balancehistory/show','BalanceHistoryController@show');


    Route::resource('order','OrderController');
    
    Route::post('email/verify', 'UserController@verifyEmail');
  
    
    Route::post('users/getpersonalinfo', 'UserController@getpersonalinfo');
    Route::post('users/settings', 'UserController@settings');
    Route::post('roles/delete', 'RoleController@deleteAll');
    Route::post('user/role', 'UserController@changeRole');
    Route::post('user/photo', 'UserController@changePhoto');
 
});
Route::post('login','Api\UserController@login')->name('login');
Route::post('clientlogin','Api\UserController@clientlogin')->name('clientlogin');
Route::post('registerclient','Api\UserController@registerclient')->name('registerclient');
Route::post('resetpassword','Api\UserController@resetpassword')->name('resetpassword');
Route::post('resetsetpassword','Api\UserController@resetsetpassword')->name('resetsetpassword');

