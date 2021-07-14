<?php

Route::get('product/set-fecture', 'Admin\ProductController@setFectured')->name('product.setfecture');
	Route::resource('product', 'Admin\ProductController');
	Route::get('product_ajax_list', 'Admin\ProductController@productAjaxList');