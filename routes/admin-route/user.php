<?php

	Route::get('/user/list', 'HomeController@index')->name('admin.userlist');
	Route::get('/user/create', 'HomeController@create')->name('admin.usercreate');
    Route::post('/user/store', 'HomeController@userstore')->name('admin.userstore');
   Route::get('/user/user_ajax_list', 'HomeController@userAjaxList')->name('admin.userget');
   Route::get('/user/edit/{id}', 'HomeController@edit')->name('admin.useredit');
   Route::PUT('/user/update/{id}', 'HomeController@update')->name('admin.userupdate');
   Route::delete('/user/destroy/{id}', 'HomeController@destroy')->name('admin.userdestroy');