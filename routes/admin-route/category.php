<?php
 
	
	Route::resource('categires', 'Admin\CategoryController');
	Route::get('category_ajax_list', 'Admin\CategoryController@categoryAjaxList');
	
 