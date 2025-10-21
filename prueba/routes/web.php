<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('artista')-> group(function(){
    Route::get('/', [\App\Http\Controllers\ArtistaController::class, 'index'])->name('artista.index');

    Route::get('/index', [ArtistaController::class, 'index'])-> name('artista.index');
    Route::get('/create', [ArtistaController::class, 'create'])-> name('artista.create');
    Route::get('/edit/{id}', [ArtistaController::class, 'edit'])-> name('artista.edit');
    Route::post('/store', [ArtistaController::class, 'store'])-> name('artista.store');
    Route::put('/update/{id}', [ArtistaController::class, 'update'])-> name('artista.update');
    Route::get('/destroy/{id}', [ArtistaController::class, 'destroy'])-> name('artista.destroy');
});