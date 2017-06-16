<?php

Auth::routes();

Route::group(['prefix' => 'account', 'middleware' => ['auth'], 'namespace' => 'account'], function () {
    Route::get('/', 'AccountController@index')->name('account');
});

Route::get('/', 'HomeController@index')->name('home');
