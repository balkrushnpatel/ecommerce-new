<?php

Route::resource('couponcode', 'Admin\CouponCodeController');
	Route::get('couponcode_ajax_list', 'Admin\CouponCodeController@couponcodeAjaxList');
	Route::get('get-category', 'Admin\CouponCodeController@getCategory');