<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', 'UserHomeController@index')->name('home');


Route::group(['prefix' => '/admin','middleware' => ['auth','role:Admin']], function () { 
	Route::get('/admin', 'HomeController@index')->name('admin.dashboard')->middleware('verified');
	$admin_real_path = realpath(__DIR__) . DIRECTORY_SEPARATOR . 'admin-route' . DIRECTORY_SEPARATOR; 
	include_once($admin_real_path . 'category.php'); 
	include_once($admin_real_path . 'subcategory.php');  
	include_once($admin_real_path . 'brand.php');
	include_once($admin_real_path . 'product.php');
	include_once($admin_real_path . 'couponcode.php');
	include_once($admin_real_path . 'productstock.php');
	include_once($admin_real_path . 'package.php');
	include_once($admin_real_path . 'slider.php');      
});

$web_real_path = realpath(__DIR__) . DIRECTORY_SEPARATOR . 'web-route' . DIRECTORY_SEPARATOR; 
include_once($web_real_path . 'product-route.php');   

Route::group(['middleware' => ['auth','role:User']], function () { 
	Route::post('cart', 'UserHomeController@addtoCart')->name('cart');
	Route::post('checkout', 'UserHomeController@checkout')->name('checkout');
	Route::get('remove-to-cart/{id}', 'UserHomeController@removetoCart')->name('removetocart');
});

Route::get('about-us', 'UserHomeController@aboutUs')->name('about-us');
Route::get('contact-us', 'UserHomeController@ContactUs')->name('contact-us');
Route::post('contact-us/send', 'UserHomeController@contactUsSend')->name('inquiry.send');

  

