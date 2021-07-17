<?php

Route::group(['middleware' => ['auth']], function () { 
	Route::get('product/set-fecture', 'Admin\ProductController@setFectured')->name('product.setfecture');
	Route::get('product/set-public', 'Admin\ProductController@setPublic')->name('product.setPublic');
	Route::get('product/set-today_deal', 'Admin\ProductController@setTodayDeal')->name('product.todayDeal');
	Route::resource('product', 'Admin\ProductController');
	Route::get('product_ajax_list', 'Admin\ProductController@productAjaxList');
	Route::get('get-sub-categories', 'Admin\ProductController@getSubcategories');
    Route::get('get-brand', 'Admin\ProductController@getBrand');
});