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

Route::post('login', 'UsersApiController@login');
Route::post('register', 'UsersApiController@register');
Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'UsersApiController@details')->middleware('verified');
}); // will work only when user has verified the email

Route::get('email/verify/{id}', 'VerificationApiController@verify')->name('verificationapi.verify');
Route::get('email/resend', 'VerificationApiController@resend')->name('verificationapi.resend');

Route::get('/applySa','APIController@getSA');
Route::post('/applySa','APIController@verifSA');
