<?php

use Illuminate\Http\Request;

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


Route::middleware('Localization')->group(function () {
//User Control Auth
Route::post('login', 'AuthController@login');
Route::post('signup', 'AuthController@signup');
Route::post('reset-password', 'AuthController@reset');
//Resource For Unknown User
Route::apiResource('Cities', 'CitiesController');
Route::apiResource('Languages', 'LanguagesApiController');
Route::apiResource('Countries', 'CountryController');
Route::apiResource('languages', 'LanguageController', ['only' => ['index']]);
Route::middleware('auth:api')->group(function () {
Route::post('confirmation', 'AuthController@confirm');
Route::middleware('Verify')->group(function () {
Route::apiResource('Services', 'ServicesController');
Route::apiResource('Child-Services', 'SubServicesController');
Route::apiResource('User/Products', 'ProductUserController');
Route::apiResource('User/Ads', 'AdsUserController');
//Protected Login To Authntcate
Route::get('logout', 'AuthController@logout');
Route::post('profile', 'AuthController@user');
Route::apiResource('User/Orders', 'OrdersUserController');
Route::apiResource('User/Payment', 'PaymentController');
Route::apiResource('Cart', 'CartController');
Route::apiResource('Bank', 'BankAccountsController');
Route::apiResource('Favourites', 'BookmarkController');
Route::apiResource('Rates', 'RatesController');
Route::group(['prefix' => '/Vendor', 'middleware' => 'VendorAccess'], function () {
Route::apiResource('Products', 'ProductsController');
Route::apiResource('Ads', 'AdvertisingController');
Route::apiResource('Percentage', 'PercentageControllerAPI');
Route::apiResource('Orders', 'OrdersController');
});
});
});
});


