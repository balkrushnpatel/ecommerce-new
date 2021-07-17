<?php

Route::resource('blogcategory', 'Admin\BlogCategoryController');
Route::get('blog_cat_ajax_list', 'Admin\BlogCategoryController@blogCatAjaxList');