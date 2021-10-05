<?php

use App\Http\Controllers\MangaController;
use App\Http\Controllers\RecommendationController;
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
    //
});

require __DIR__.'/auth.php';
