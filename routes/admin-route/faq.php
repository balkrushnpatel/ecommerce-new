<?php
 
	Route::resource('faq', 'Admin\FaqController');
	Route::get('faqRemove', 'Admin\FaqController@faqRemove');
	