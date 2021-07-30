<?php

	Route::resource('banner', 'Admin\BannerController');
	Route::get('banner_ajax_list', 'Admin\BannerController@bannerAjaxList');
