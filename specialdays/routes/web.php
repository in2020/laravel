<?php

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
//
//include_once "sections/admin/Admin.php";
//include_once "sections/admin/AdminActivity.php";
//include_once "sections/admin/AdminPlace.php";
//
//include_once "sections/customer/Customer.php";
//include_once "sections/customer/CustomerActivity.php";
//include_once "sections/customer/CustomerPlace.php";
//include_once "sections/customer/CustomerSetting.php";
//
//
//Route::domain(env('API_DOMAIN'))->group(function () {
//    Route::prefix('v1')->group(function () {
//        Route::resource('places', 'PlaceController');
//        Route::resource('activities', 'ActivityController');
//    });
//});
//
//Route::domain(env('APP_SUB_DOMAIN_1'))->group(function () {
//    Route::redirect('/here', '/there', 301);
//});
//
//Route::domain(env('APP_SUB_DOMAIN_2'))->group(function () {
//    Route::redirect('/here', '/there', 301);
//});
//
//Route::domain(env('APP_SUB_DOMAIN_3'))->group(function () {
//    Route::redirect('/here', '/there', 301);
//});
//
//Route::domain(env('APP_DOMAIN'))->group(function () {
//    Auth::routes();
//
//    //Customer
//    Customer::routes();
//    CustomerActivity::routes();
//    CustomerPlace::routes();
//    CustomerSetting::routes();
//
//    //Admin
//    Route::prefix('admin')->group(function () {
//        //Admin
//        Admin::routes();
//        AdminPlace::routes();
//        AdminActivity::routes();
//    });
//});

Route::get('/', 'EventController@index');