<?php 
Route::group(['prefix' => '/cart'], function () {
	Route::get('/', 'CartController@index')->name('cart'); 
	Route::get('/checkout', 'CartController@checkout')->name('checkout'); 
});