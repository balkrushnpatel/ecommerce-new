<?php

Route::resource('slider', 'Admin\SliderController');
	Route::get('slider_ajax_list', 'Admin\SliderController@sliderAjaxList');