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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('mess', 'MessController@store')->name('mess.store');
Route::get('mess', 'MessController@index')->name('mess.index');
Route::get('mess/create', 'MessController@create')->name('mess.create');
Route::get('mess/mess/{id}', 'MessController@show')->name('mess.show');
Route::get('mess/ushow', 'MessController@ushow')->name('mess.ushow');
Route::match(['put', 'patch'], 'mess/{mess}', 'MessController@markAsViewed')->name('mess.markAsViewed');