<?php

Route::resource('package', 'Admin\PackageController');
	Route::get('package_ajax_list', 'Admin\PackageController@packageAjaxList');