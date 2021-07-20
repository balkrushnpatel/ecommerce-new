<?php


Route::get('privacy-policy', 'UserHomeController@privacyPolicy')->name('privacy-policy');
Route::get('term-and-condition', 'UserHomeController@termAndCondition')->name('term-condition');
Route::get('about-us', 'UserHomeController@aboutUs')->name('about-us');
Route::get('contact-us', 'UserHomeController@ContactUs')->name('contact-us');
Route::post('contact-us/send', 'UserHomeController@contactUsSend')->name('inquiry.send');


Route::get('headersearch','UserHomeController@headersearch')->name('search');

?>