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

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/', 'HomeController@index');
//Route::get('messages', 'ChatsController@fetchMessages');
//Route::post('messages', 'ChatsController@sendMessage');
Route::get('home', 'HomeController@index')->name("home");
Route::get('/user/country/cities','SingleJsonController@city');
Route::get('/clear', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    return 'DONE'; //Return anything
});

Route::group(['middleware' => ['Blocked']], function () {
Route::group(['middleware' => ['auth']], function () {
Route::group(['middleware' => ['setlanguage']], function () {
Route::post('/user/password', 'UserController@changePassword');
Route::get('/location', 'HomeController@locations');
Route::get('language/{language_id}', 'HomeController@setLanguage');
Route::get('user/orders/statistics', 'OrderController@userStatistics');
Route::post('user/token','UserController@updateUserFireBaseToken');
Route::get('user/orders/statistics','OrderController@userStatistics');


Route::group(['prefix' => '/admin', 'middleware' => 'Admin'], function () {
Route::get('/', 'HomeController@admin')->name('adminHome');
Route::resource('profile', 'UserController', ['only' => ['show', 'update']]);
Route::resource('languages', 'LanguageController', ['except' => ['destroy', 'show']]);
Route::resource('countries','CountryAdminController',['except' => ['destroy' , 'show']]);
Route::resource('cities','CityController',['except' => ['destroy' , 'show']]);
Route::resource('categories', 'CategoryAdminController', ['except' => ['destroy', 'show']]);
Route::resource('services', 'ServiceTypeAdminController', ['except' => ['destroy', 'show']]);
Route::resource('orders', 'OrderController', ['only' => ['index', 'show']]);
Route::post('orders/refuse', 'OrderController@adminRefuseOrder');
Route::post('orders/assign','OrderController@adminAssignDeliveryToOrder');
Route::resource('provider', "ProviderController");
Route::get('provider/activation/{providerId}' , 'ProviderController@adminProviderActivation');
Route::get('activation/{id}' , 'AdminController@adminActivation');
Route::resource('payment', "ProviderController");
Route::resource('users/admin', "AdminController");
});

Route::group(['prefix' => '/provider', 'middleware' => 'Providers'], function () {
Route::get('/', 'HomeController@provider')->name('providerHome');
Route::resource('profile', 'UserController', ['only' => ['show', 'update']]);
Route::resource('orders', 'UserController');
Route::resource('ads', 'AdsVendorController');
Route::resource('products', 'ProductsVendorController');
});
});
});
});

