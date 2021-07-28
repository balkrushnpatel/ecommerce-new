<?php

Route::group(['prefix' => '/category'], function () {
	Route::get('/', 'ProductController@index')->name('category');
	Route::get('/{id}/{slug}', 'ProductController@index')->name('category.product');
});
Route::group(['prefix' => '/subcategory'], function () { 
	Route::get('/', 'ProductController@index')->name('subcategory');
	Route::get('/{id}/{slug}', 'ProductController@index')->name('subcategory.product');
});
Route::group(['prefix' => '/brand'], function () { 
	Route::get('/', 'ProductController@index')->name('all.brand');
	Route::get('/{id}/{slug}', 'ProductController@index')->name('brand.product');
});

Route::group(['prefix' => '/product'], function () {
	Route::get('/', 'ProductController@index')->name('product');
	
	Route::get('/today-deal', 'ProductController@index')->name('today-deal');
	Route::get('/featured', 'ProductController@index')->name('product.fecture');
	Route::get('/classifieds', 'ProductController@index')->name('product.classifieds');
	Route::get('/search','ProductController@index')->name('product.search');

	
	Route::get('/{id}/{slug}', 'ProductController@index')->name('product.detail');
	Route::get('/today/deal', 'ProductController@index')->name('product.today_deal');
	Route::get('/{id}/{slug}', 'ProductController@index')->name('product.detail');
	Route::get('/compare', 'ProductController@Compare')->name('compare');
	Route::get('/get-list', 'ProductController@productFilter')->name('product.filter');	

});