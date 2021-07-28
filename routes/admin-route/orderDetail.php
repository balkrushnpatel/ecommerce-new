<?php
 
	Route::resource('orderDetail', 'Admin\OrderDetailController');
	Route::get('orderDetail_ajax_list', 'Admin\OrderDetailController@orderDetailAjaxList');
	Route::get('orderView/{id}','Admin\OrderDetailController@orderView')->name('orders.view');
	
	