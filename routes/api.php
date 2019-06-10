<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api'], function() {

    //userController
    //Route::post('user', 'UserController@create')->name('user.create');

    Route::group(['middleware' => 'auth:api'], function() {

        //userController
        //Route::get('user', 'UserController@get')->name('user.get');
        //Route::put('user', 'UserController@update')->name('user.update');
        //Route::patch('user', 'UserController@updatePartially')->name('user.partially');
        //Route::delete('user', 'UserController@delete')->name('user.delete');

        //userTransactionController
        Route::get('user/transaction', 'UserTransactionController@get')->name('user.transaction.get');
        Route::post('user/transaction', 'UserTransactionController@create')->name('user.transaction.create');
        Route::put('user/transaction', 'UserTransactionController@update')->name('user.transaction.update');
        Route::patch('user/transaction', 'UserTransactionController@updatePartially')->name('user.transaction.partially');
        Route::delete('user/transaction', 'UserTransactionController@delete')->name('user.transaction.delete');

    });
});
