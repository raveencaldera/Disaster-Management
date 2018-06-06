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

Route::get('/', 'HomeController@home')->name('main');

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/dashboard', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/report', 'ReportController@index')->name('report.index')->middleware('auth');
Route::get('/toggleReport', 'ReportController@toggleStatus')->name('report.toggle');
Route::post('/report', 'ReportController@store')->name('report.store');
Route::get('/report', 'ReportController@index')->name('report.index')->middleware('auth');
Route::get('/editReport', 'ReportController@editView')->name('report.edit')->middleware('auth');
Route::post('/updateReport', 'ReportController@updateReport')->name('report.update')->middleware('auth');
Route::get('/reportDelete', 'ReportController@deleteReport')->name('report.delete');

Route::get('/users', 'UserController@index')->name('users.index')->middleware('auth');
Route::get('/toggleUser', 'UserController@toggleUser')->name('user.toggle');
Route::post('/addUser', 'UserController@addUser')->name('add.user');
Route::get('/userDelete', 'UserController@deleteUser')->name('user.delete');
Route::get('/editUser', 'UserController@editView')->name('user.edit')->middleware('auth');
Route::post('/updateUser', 'UserController@updateUser')->name('user.update')->middleware('auth');