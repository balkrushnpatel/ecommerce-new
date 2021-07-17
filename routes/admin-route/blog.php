<?php

	Route::resource('blog', 'Admin\BlogController');
	Route::get('blog_ajax_list', 'Admin\BlogController@blogAjaxList');
