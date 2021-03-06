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
Route::put('/update/{id}','updateController@update');
Route::get('/annonces', 'annonceController@index');
Route::get('/annonces/{id}', 'annonceController@show');
Route::get('/annoncesshow', 'annonceController@create');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/dashboard','adminController@index');
Route::get('/emails','ContactController@index');


