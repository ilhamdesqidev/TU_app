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


Route::resource('klapper', KlapperController::class);
Route::post('klapper/{klapper_id}/add-siswa', [KlapperController::class, 'addSiswa'])->name('klapper.addSiswa');
// Route::get('klapper', [KlapperController::class, 'index']);
Route::get('/klapper', [KlapperController::class, 'index'])->name('klapper.index');
Route::get('/tambah_siswa', [KlapperController::class, 'index'])->name('klapper');
Route::get('/klapper/tambahdataklapper', [KlapperController::class, 'create'])->name('klapper.create');
Route::post('/klapper', [KlapperController::class, 'store'])->name('klapper.store');
Route::get('/klapper/tambah_siswa', [KlapperController::class, 'create'])->name('klapper.create');
Route::post('/klapper', [KlapperController::class, 'store'])->name('klapper.store');
Route::get('/klapper/{id}', [KlapperController::class, 'show'])->name('klapper.show');
