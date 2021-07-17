<?php
 
	
	Route::resource('brand', 'Admin\BrandController');
	Route::get('brand_ajax_list', 'Admin\BrandController@brandAjaxList');
	 