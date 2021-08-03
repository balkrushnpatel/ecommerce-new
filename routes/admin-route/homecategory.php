<?php

    Route::GET('home-category/delete','Admin\HomeCategoryController@delete')->name('homecategory.delete');
	Route::resource('home-category', 'Admin\HomeCategoryController');

	
	
