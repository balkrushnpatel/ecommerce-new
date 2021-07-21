<?php

	Route::get('/user/list', 'AdminController@index')->name('admin.userlist');
	Route::get('/user/create', 'AdminController@create')->name('admin.usercreate');
    Route::post('/user/store', 'AdminController@userstore')->name('admin.userstore');
   Route::get('/user/user_ajax_list', 'AdminController@userAjaxList')->name('admin.userget');
   Route::get('/user/edit/{id}', 'AdminController@edit')->name('admin.useredit');
   Route::PUT('/user/update/{id}', 'AdminController@update')->name('admin.userupdate');
   Route::delete('/user/destroy/{id}', 'AdminController@destroy')->name('admin.userdestroy');