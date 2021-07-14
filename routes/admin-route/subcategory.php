<?php

Route::resource('subcategory', 'Admin\SubCategoryController');
	Route::get('subcategory_ajax_list', 'Admin\SubCategoryController@subcategoryAjaxList');