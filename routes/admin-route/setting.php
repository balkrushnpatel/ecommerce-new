<?php
 Route::group(['prefix' => '/setting'], function () { 
	Route::get('home', 'Admin\SettingController@index')->name('setting');
	Route::post('homesetting', 'Admin\SettingController@homesetting')->name('home.setting');
	Route::get('contact', 'Admin\SettingController@contact')->name('admin.contact');
	Route::post('contactsetting', 'Admin\SettingController@contactsetting')->name('contact.setting');

	Route::get('footer', 'Admin\SettingController@footer')->name('admin.footer');
	Route::post('footer/setting/update', 'Admin\SettingController@footersetting')->name('footer.setting');

	Route::get('favicon', 'Admin\SettingController@favicon')->name('admin.favicon');
	Route::post('favicon/update', 'Admin\SettingController@faviconsetting')->name('favicon.setting');

	Route::get('logo', 'Admin\SettingController@logo')->name('admin.logo');
	Route::post('setting/logo/update', 'Admin\SettingController@logosetting')->name('logo.setting');

	Route::get('general', 'Admin\SettingController@general')->name('admin.general');
	Route::post('generalsetting', 'Admin\SettingController@generalsetting')->name('general.setting');
 
    Route::get('header', 'Admin\SettingController@header')->name('admin.header');

	Route::get('headersetting', 'Admin\SettingController@setHeader')->name('header.setting');
});