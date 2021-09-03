<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', 'API\AuthController@login'); 
Route::post('/register','API\AuthController@register');
Route::post('/reset-password', 'api\authcontroller@resetpassword')->name('reset.password');
Route::get('/reset-password/{otp}', 'api\authcontroller@resetnewpassword')->name('reset.new.password');
Route::post('/update-password', 'api\authcontroller@updatepassword')->name('update.password');
Route::post('/check-back-office-email', 'api\authcontroller@checkbackofficeemail')->name('check.email');
Route::post('/update-reset-password', 'api\authcontroller@updateresetpassword')->name('check.reset.password');

Route::middleware('auth:api')->group( function () {
	Route::get('product/list-api', 'API\ProductController@index');
	Route::post('products/create', 'API\ProductController@store');
    Route::post('products/update/{id}', 'API\ProductController@update');
    Route::delete('products/delete/{id}','API\ProductController@destroy');
});
