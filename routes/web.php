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

Route::get('/sa', 'SAController@sa');
Route::post('/sa', 'SAController@applySA');
Route::get('/verifySA', 'SAController@verifySA');
Route::post('/verifySA', 'SAController@verSA');

Route::post('/mou', 'MOUController@create');
Auth::routes();
Route::post('/push','PushController@store');
Route::get('/home', 'HomeController@index')->name('home');
