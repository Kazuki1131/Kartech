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

Route::get('/', function () { return view('top'); })->name('top');

Auth::routes();

//ゲストユーザーログイン
Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/search/customers', 'CustomerController@search')->name('customers.search');
    Route::resource('customers', 'CustomerController');
    Route::resource('visited_records', 'VisitedRecordController');
    Route::resource('surveys', 'SurveyController');
    Route::resource('menus', 'MenuController');
});
