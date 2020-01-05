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

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/postr','annonceController@store');
Route::delete('/del/{id}','annonceController@destroy');
Route::get('/gd','annonceController@showphones');
Route::get('/mdl/{id}','annonceController@phonedetail');
Route::patch('/update/{id}','updateController@update');
Route::get('/messages','ContactController@create');
Route::get('/admindata','adminController@create');
Route::delete('/addel/{id}','adminController@destroy');
Route::delete('/addelus/{id}','adminController@destroyuser');
Route::get('/graph','annonceController@graph');
Route::put('/upstatus/{id}','annonceController@upstats');
Route::post('/contact','ContactController@store');