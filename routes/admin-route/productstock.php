<?php

Route::resource('productstock', 'Admin\ProductStockController');
Route::get('productstock_ajax_list', 'Admin\ProductStockController@productstockAjaxList');
Route::get('get-sub-category', 'Admin\ProductStockController@getSubcategory');
Route::get('get-product', 'Admin\ProductStockController@getProduct');
Route::get('get-price', 'Admin\ProductStockController@getProductPrice');
Route::get('destroy-stock', 'Admin\ProductStockController@destroystock')->name('destroy.stock');