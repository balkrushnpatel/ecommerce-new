<?php


Route::get('privacy-policy', 'HomeController@privacyPolicy')->name('privacy-policy');
Route::get('term-and-condition', 'HomeController@termAndCondition')->name('term-condition');
Route::get('about-us', 'HomeController@aboutUs')->name('about-us');
Route::get('contact-us', 'HomeController@ContactUs')->name('contact-us');
Route::post('contact-us/send', 'HomeController@contactUsSend')->name('inquiry.send');


Route::get('headersearch','HomeController@headersearch')->name('search');

Route::get('cart/header-box', 'CartController@headerCart')->name('cart.headerBox'); 
Route::get('cart/product', 'CartController@addToCart')->name('product.addcart'); 
Route::get('cart/remove-product', 'CartController@removeProductCart')->name('remove.productcart'); 

Route::group(['prefix' => '/blog'], function () { 
	Route::get('/', 'ProductController@blogs')->name('blogs');
	Route::get('/{id}/{slug}', 'ProductController@index')->name('blogs.detail');
});
?>