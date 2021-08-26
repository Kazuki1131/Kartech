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

Route::resource('customers', 'CustomerController')->middleware('auth');

Route::resource('visited_records', 'VisitedRecordController')->middleware('auth');

Route::resource('questionnaires', 'QuestionnaireController')->middleware('auth');
