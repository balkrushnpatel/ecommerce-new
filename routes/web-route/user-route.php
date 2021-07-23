<?php 
Route::group(['prefix' => '/user'], function () {
	Route::get('/my-account', 'UserController@myAccount')->name('user.acount');
	Route::get('/wishlist', 'ProductController@index')->name('user.wishlist');
	Route::get('/order-detail', 'CartController@orderDetail')->name('order.detail');
	Route::post('/account-detail', 'UserController@accountDetail')->name('account.detail');
	Route::get('/order-view/{id}', 'UserController@orderView')->name('order.view');
});