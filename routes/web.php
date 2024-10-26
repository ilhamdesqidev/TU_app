<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlapperController;
use App\Http\Controllers\Tambah_siswaController;

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

Route::get('show', [Tambah_siswaController::class, 'index']);
Route::get('show/tambah_siswa', [Tambah_siswaController::class, 'create']);
Route::post('show', [Tambah_siswaController::class, 'store']);
Route::delete('show/{id}', [Tambah_siswaController::class, 'delete']);
Route::get('detail_siswa/{iddetail_siswa}', [Tambah_siswaController::class, 'detail_siswa'])->name('detail_siswa');

// Route::get('show/{id}', [Tambah_siswaController::class, 'show'])->name
// Route::get('show/{id}', [Tambah_siswaController::class, 'show']);
// Route::get('/admin/klapper/detail_siswa/{iddetail_siswa}', [SiswaController::class, 'detail_siswa'])->name('detail_siswa');