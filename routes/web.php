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

Route::get('/', 'HomeController@index')->name('home');


Route::get('/admin', 'AdminController@index')->name('admin.dashboard')->middleware('verified');

Route::group(['prefix' => '/admin','middleware' => ['auth','role:Admin']], function () { 
	$admin_real_path = realpath(__DIR__) . DIRECTORY_SEPARATOR . 'admin-route' . DIRECTORY_SEPARATOR; 

	Route::get('profile', 'Admin\AdminProfileController@edit')->name('profile.edit');
	Route::PUT('profile', 'Admin\AdminProfileController@update')->name('profile.update');
	
	include_once($admin_real_path . 'category.php'); 
	include_once($admin_real_path . 'subcategory.php');  
	include_once($admin_real_path . 'brand.php');
	include_once($admin_real_path . 'product.php');
	include_once($admin_real_path . 'couponcode.php');
	include_once($admin_real_path . 'productstock.php');
	include_once($admin_real_path . 'package.php');
	include_once($admin_real_path . 'slider.php');
	include_once($admin_real_path . 'blogcategory.php'); 
	include_once($admin_real_path . 'blog.php');
	include_once($admin_real_path . 'setting.php');
	include_once($admin_real_path . 'language.php');
	include_once($admin_real_path . 'user.php');
	include_once($admin_real_path . 'faq.php');
	Route::PUT('profile/password', 'Admin\AdminProfileController@password')->name('profile.password');
});

$web_real_path = realpath(__DIR__) . DIRECTORY_SEPARATOR . 'web-route' . DIRECTORY_SEPARATOR; 
include_once($web_real_path . 'web-route.php');   
include_once($web_real_path . 'product-route.php');   

Route::group(['middleware' => ['auth','role:User']], function () { 
	$web_real_path = realpath(__DIR__) . DIRECTORY_SEPARATOR . 'web-route' . DIRECTORY_SEPARATOR;
	include_once($web_real_path . 'user-route.php');  
	Route::post('cart', 'HomeController@addtoCart')->name('cart');
	Route::post('checkout', 'HomeController@checkout')->name('checkout');
	Route::get('remove-to-cart/{id}', 'HomeController@removetoCart')->name('removetocart');
});


  

