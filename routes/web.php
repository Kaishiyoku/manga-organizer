<?php

Route::group(['middleware' => 'menus'], function () {
    Route::get('/', 'MangaController@index')->name('mangas.index');
    Route::get('/plain', 'MangaController@indexPlain')->name('mangas.index_plain');
    Route::get('/statistics', 'MangaController@statistics')->name('mangas.statistics');

    Route::resource('recommendations', 'RecommendationController', ['only' => ['create', 'store']]);

    Route::post('/lang/change', 'LanguageController@change')->name('language.change');

    Route::get('/contact', 'HomeController@showContactForm')->name('home.show_contact_form');
    Route::post('/contact', 'HomeController@sendContactForm')->name('home.send_contact_form');

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

        Route::prefix('mangas/{manga}')->group(function () {
            Route::post('volumes', 'VolumeController@store')->name('volumes.store');
            Route::delete('volumes/{volume}', 'VolumeController@destroy')->name('volumes.destroy');

            Route::post('specials', 'SpecialController@store')->name('specials.store');
            Route::delete('specials/{special}', 'SpecialController@destroy')->name('specials.destroy');
        });

        Route::resource('recommendations', 'RecommendationController', ['only' => 'destroy']);

        Route::get('settings', 'SettingController@index')->name('settings.index');
        Route::get('/settings/password/change', 'SettingController@editPassword')->name('settings.edit_password');
        Route::put('/settings/password/change', 'SettingController@updatePassword')->name('settings.update_password');
    });

    Route::get('text', 'HomeController@toggleAsText')->name('home.toggle_as_text');
});
