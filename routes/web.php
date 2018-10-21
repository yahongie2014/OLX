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

use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/chat', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');
Route::get('home', 'HomeController@index')->name("home");
Route::get("/", function () {
return view("welcome");
});
Route::get('/user/country/cities','HomeController@cities');


Route::group(['middleware' => ['auth']], function () {
Route::group(['middleware' => ['setlanguage']], function () {
Route::get('/', 'HomeController@index');
Route::get('notadmin', 'HomeController@notAdmin');
Route::get('notprovider', 'HomeController@notProvider');
Route::get('notdelivery', 'HomeController@notDelivery');
Route::post('/user/password', 'UserController@changePassword');

Route::get('/location', 'HomeController@locations');

Route::group(['prefix' => '/admin', 'middleware' => 'isadmin'], function () {

Route::get('/', 'HomeController@admin')->name('adminHome');

Route::resource('provider', 'ProviderController', ['only' => ['index', 'update']]);
Route::get('provider/activation/{providerId}', 'ProviderController@adminProviderActivation');


Route::resource('delivery', 'DeliveryController', ['only' => ['index', 'show']]);
Route::get('delivery/activation/{providerId}', 'DeliveryController@adminDeliveryActivation');

Route::resource('profile', 'UserController', ['only' => ['show', 'update']]);

Route::resource('orders', 'OrderController', ['only' => ['index', 'show']]);
Route::post('orders/refuse', 'OrderController@adminRefuseOrder');
Route::post('orders/assign', 'OrderController@adminAssignDeliveryToOrder');

Route::resource('languages', 'LanguageController', ['except' => ['destroy', 'show']]);
Route::resource('countries', 'CountryController', ['except' => ['destroy', 'show']]);
Route::resource('cities', 'CityController', ['except' => ['destroy', 'show']]);
Route::resource('cartypes', 'CarTypesController', ['except' => ['destroy', 'show']]);
Route::resource('categories', 'CategoryController', ['except' => ['destroy', 'show']]);
Route::resource('services', 'ServiceTypeController', ['except' => ['destroy', 'show']]);
Route::resource('paytypes', 'PaymentTypeController', ['except' => ['destroy', 'show']]);


});

Route::group(['prefix' => '/provider', 'middleware' => 'isprovider'], function () {
Route::get('/', 'HomeController@provider')->name('providerHome');
Route::resource('profile', 'UserController', ['only' => ['show', 'update']]);
Route::resource('orders', 'OrderController', ['only' => ['create', 'store', 'index', 'show', 'edit', 'update']]);
Route::resource('loading', 'ProviderLoadingController', ['only' => ['create', 'store', 'index', 'show', 'edit', 'update']]);
Route::post('orders/cancel', 'OrderController@providerCancelOrder');
Route::post('client', 'OrderController@getClientLastOrderInformation');
});

Route::group(['prefix' => '/delivery', 'middleware' => 'isdelivery'], function () {
Route::get('/', 'HomeController@delivery')->name('deliveryHome');
Route::resource('profile', 'UserController', ['only' => ['show', 'update']]);

Route::get('orders/action/{orderId}/{actionId}', 'OrderController@deliveryNextStep');
Route::resource('info', 'DeliveryController', ['only' => ['update']]);

Route::resource('orders', 'OrderController', ['only' => ['index', 'show']]);
Route::get('orders/status/{orderId}/{status}', 'OrderController@deliveryNextStep');
});
});
Route::get('language/{language_id}', 'HomeController@setLanguage');
Route::post('user/token', 'UserController@updateUserFireBaseToken');

Route::get('user/orders/statistics', 'OrderController@userStatistics');

});

