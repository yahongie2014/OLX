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
Route::get('/user/country/cities','HomeController@cities');


Route::group(['middleware' => ['auth']], function () {
Route::group(['middleware' => ['setlanguage']], function () {
Route::get('/', 'HomeController@index');
Route::post('/user/password', 'UserController@changePassword');
});
Route::get('language/{language_id}', 'HomeController@setLanguage');
Route::post('user/token', 'UserController@updateUserFireBaseToken');

Route::get('user/orders/statistics', 'OrderController@userStatistics');

});

