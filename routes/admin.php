<?php

use Illuminate\Support\Facades\Route;

Route::resource('users','UserController');

Route::resource('categories','CategoryController');
