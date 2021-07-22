<?php 
Route::group(['prefix' => '/user'], function () {
	Route::get('/my-account', 'ProductController@index')->name('user.acount');
	Route::get('/wishlist', 'ProductController@index')->name('user.wishlist');
	Route::get('/order-detail', 'CartController@orderDetail')->name('order.detail');
});