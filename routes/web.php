<?php

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

Auth::routes();

//FRONTEND WEB ROUTES
Route::group(['namespace' => 'Frontend'], function () {
    Route::group(['middleware' => ['auth' /*, 'verified'*/]], function () {
        Route::get('/', 'HomeController@index')->name('home');
    });
});
