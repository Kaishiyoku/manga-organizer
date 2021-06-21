<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SpecialController;
use App\Http\Controllers\VolumeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'menus'], function () {
    Route::get('/', [MangaController::class, 'index'])->name('mangas.index');
    Route::get('/plain', [MangaController::class, 'indexPlain'])->name('mangas.index_plain');
    Route::get('/statistics', [MangaController::class, 'statistics'])->name('mangas.statistics');

    Route::resource('recommendations', RecommendationController::class, ['only' => ['create', 'store']]);

    Route::post('/lang/change', [LanguageController::class, 'change'])->name('language.change');

    Route::get('/contact', [HomeController::class, 'showContactForm'])->name('home.show_contact_form');
    Route::post('/contact', [HomeController::class, 'sendContactForm'])->name('home.send_contact_form');

    // Authentication Routes...
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login_form');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Password Reset Routes...
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset_form');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');

    Route::group(['middleware' => 'auth'], function () {
        Route::resource('mangas', MangaController::class, ['except' => ['index', 'show']]);
        Route::get('mangas/manage', [MangaController::class, 'manage'])->name('mangas.manage');

        Route::post('mangas/search', [MangaController::class, 'search'])->name('mangas.search');

        Route::prefix('mangas/{manga}')->group(function () {
            Route::post('volumes', [VolumeController::class, 'store'])->name('volumes.store');
            Route::delete('volumes/{volume}', [VolumeController::class, 'destroy'])->name('volumes.destroy');

            Route::post('specials', [SpecialController::class, 'store'])->name('specials.store');
            Route::delete('specials/{special}', [SpecialController::class, 'destroy'])->name('specials.destroy');
        });

        Route::resource('recommendations', RecommendationController::class, ['only' => 'destroy']);

        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::get('/settings/password/change', [SettingController::class, 'editPassword'])->name('settings.edit_password');
        Route::put('/settings/password/change', [SettingController::class, 'updatePassword'])->name('settings.update_password');
    });

    Route::get('text', [HomeController::class, 'toggleAsText'])->name('home.toggle_as_text');
});
