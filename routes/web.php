<?php

Route::get('/', 'MangaController@index')->name('mangas.index');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login_form');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset_form');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('mangas', 'MangaController', ['except' => ['index', 'show']]);
    Route::get('mangas/manage', 'MangaController@manage')->name('mangas.manage');
});