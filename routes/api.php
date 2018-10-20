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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//User Control Auth
Route::post('login', 'AuthController@login');
Route::post('signup', 'AuthController@signup');
Route::post('reset-password', 'AuthController@reset');
//Resource For Unknown User
Route::apiResource('Cities','CitiesController');
Route::apiResource('Countries','CountryController');
Route::apiResource('Services','ServicesController');
Route::apiResource('Child-Services','SubServicesController');
Route::apiResource('User/Products','ProductUserController');
Route::apiResource('User/Ads','AdsUserController');
//Protected Login To Authntcate
Route::middleware('auth:api')->group( function () {
Route::post('confirmation', 'AuthController@confirm');
Route::get('logout', 'AuthController@logout');
Route::post('profile', 'AuthController@user');
Route::apiResource('Vendor/Products','ProductsController');
Route::apiResource('Vendor/Ads','AdvertisingController');
Route::apiResource('Bank','BankAccountsController');
Route::apiResource('Favourites','BookmarkController');
Route::apiResource('Vendor/Orders','OrdersController');
Route::apiResource('Rates','RatesController');
});




