<?php

Auth::routes();

Route::group(['prefix' => '/account', 'middleware' => ['auth'], 'namespace' => 'account'], function () {
    Route::get('/', 'AccountController@index')->name('account');
    
    Route::group(['prefix' => '/files'], function () {
        Route::get('/', 'FileController@index')->name('account.files.index');
        Route::post('/{file}', 'FileController@store')->name('account.files.store');
        Route::patch('/{file}', 'FileController@update')->name('account.files.update');
        Route::get('/{file}/edit', 'FileController@edit')->name('account.files.edit');
        Route::get('/create', 'FileController@create')->name('account.files.create.start');
        Route::get('{file}/create', 'FileController@create')->name('account.files.create');
    });
});
Route::get('/', 'HomeController@index')->name('home');