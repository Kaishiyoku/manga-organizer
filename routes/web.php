<?php

Route::get('/', 'MangaController@index')->name('manga.index');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('auth.login_form');
Route::post('login', 'Auth\LoginController@login')->name('auth.login');
Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset_form');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');
