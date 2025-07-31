<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\KategoriController;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/antrian', [AntrianController::class, 'index'])->name('antrian.index');
Route::get('/antrian/json', [AntrianController::class, 'json'])->name('antrian.json');
Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');
Route::post('/antrian', [AntrianController::class, 'store'])->name('antrian.store');
Route::post('/antrian/undo', [AntrianController::class, 'undo'])->name('antrian.undo');
Route::put('/antrian/{id}', [AntrianController::class, 'update'])->name('antrian.update');


