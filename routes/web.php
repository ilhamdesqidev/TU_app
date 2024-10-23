<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlapperController;
use App\Http\Controllers\TambahsiswaController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('main', function () {
    return view('main');
});


Route::get('klapper', [KlapperController::class, 'index']);
Route::get('klapper/tambahdataklapper', [KlapperController::class, 'create']);
Route::post('klapper', [KlapperController::class, 'store']);
Route::delete('klapper/{id}', [KlapperController::class, 'delete']);
// Route::get('klapper/{id}', [KlapperController::class, 'show'])->name('klapper.show');
Route::get('klapper/{id}', [KlapperController::class, 'show']);

// Tambahkan rute untuk show, edit, update sesuai kebutuhan

Route::get('klapper/tambah_siswa', [TambahsiswaController::class, 'create']);
Route::post('klapper', [TambahsiswaController::class, 'store']);
