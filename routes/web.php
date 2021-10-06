<?php

use App\Http\Controllers\MangaController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\SpecialController;
use App\Http\Controllers\VolumeController;
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

Route::get('/', [MangaController::class, 'index'])->name('mangas.index');
Route::get('/plain', [MangaController::class, 'indexPlain'])->name('mangas.index_plain');
Route::get('/statistics', [MangaController::class, 'statistics'])->name('mangas.statistics');

Route::resource('recommendations', RecommendationController::class, ['only' => ['create', 'store']]);

Route::group(['middleware' => 'auth'], function () {
    Route::resource('mangas', MangaController::class, ['except' => ['index', 'show']]);
    Route::get('mangas/manage', [MangaController::class, 'manage'])->name('mangas.manage');

    Route::prefix('mangas/{manga}')->group(function () {
        Route::post('volumes', [VolumeController::class, 'store'])->name('volumes.store');
        Route::delete('volumes/{volume}', [VolumeController::class, 'destroy'])->name('volumes.destroy');

        Route::post('specials', [SpecialController::class, 'store'])->name('specials.store');
        Route::delete('specials/{special}', [SpecialController::class, 'destroy'])->name('specials.destroy');
    });

    Route::resource('recommendations', RecommendationController::class, ['only' => ['index', 'destroy']]);
});

require __DIR__.'/auth.php';
