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

Route::group(['middleware' => 'roles','roles'=>['admin','test']], function () {
	Route::get('/sa', 'SAController@sa');
	Route::post('/verifySA', 'SAController@verSA');
	Route::post('/sa', 'SAController@applySA');
});

Route::group(['middleware'=>'roles','roles'=>'normal'],function (){
	Route::get('/verifySA', 'SAController@verifySA');
});

Route::post('/mou', 'MOUController@create');
Auth::routes();
Route::post('/push','PushController@store');
Route::get('/home', 'HomeController@index')->name('home');
