<?php
 
	Route::resource('language', 'Admin\LanguageController');
	Route::get('language_ajax_list', 'Admin\LanguageController@languageAjaxList');
	 