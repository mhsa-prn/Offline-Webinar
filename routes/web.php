<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@firstPage');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('getCode',[\App\Http\Controllers\Auth\AuthController::class,'getCode'])->name('getCode');

Route::get('getCode',[\App\Http\Controllers\Auth\AuthController::class,'getCodePage'])->name('getCodePage');

Route::post('login',[\App\Http\Controllers\Auth\AuthController::class,'login'])->name('login');
Route::get('logout',[\App\Http\Controllers\Auth\AuthController::class,'logout'])->name('logout');

Route::resource('webinars','WebinarController');

Route::get('/payment/pay/{webinar}','PaymentController@pay')->name('payment.pay');
Route::get('/payment/verify','PaymentController@verify')->name('payment.verify');

Route::get('/webinar/download/{user}','WebinarController@download')->name('webinars.download')->middleware('signed');


