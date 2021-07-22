<?php 
Route::group(['prefix' => '/cart'], function () {
	Route::get('/', 'CartController@index')->name('cart'); 
	Route::post('/checkout', 'CartController@checkout')->name('checkout'); 
	Route::post('/place-order', 'CartController@placeOrder')->name('order.place'); 
	Route::get('/clear', 'CartController@clearCart')->name('cart.clear'); 
	Route::get('/view-cart', 'CartController@viewCart')->name('cart.view'); 
	Route::get('/qty-add-minus', 'CartController@qtyAddMinus')->name('qty.add.minus'); 
	Route::get('/apply-coupon', 'CartController@applyCoupon')->name('cart.applycoupon'); 
});