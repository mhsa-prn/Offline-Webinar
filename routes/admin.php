<?php

use Illuminate\Support\Facades\Route;

Route::resource('users','UserController');

Route::resource('categories','CategoryController');

Route::resource('webinars','WebinarController');

Route::get('/webinar/download/{file}','WebinarController@download')->name('webinars.download');

