<?php
 
	Route::resource('orderDetail', 'Admin\OrderDetailController');
	Route::get('orderDetail_ajax_list', 'Admin\OrderDetailController@orderDetailAjaxList');
	Route::get('orderView/{id}','Admin\OrderDetailController@orderView')->name('orders.view');
	Route::post('delivery','Admin\OrderDetailController@deliveryDetail')->name('delivery.payment');
	
	
	