<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlapperController;
// use App\Http\Controllers\Tambah_siswaController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('main', function () {
    return view('main');
});

// // Routes untuk Klapper
// Route::get('/klapper', [KlapperController::class, 'indexKlapper'])->name('klapper.index');
// Route::get('/klapper/tambahdataklapper', [KlapperController::class, 'createKlapper'])->name('klapper.create');
// Route::post('/klapper', [KlapperController::class, 'storeKlapper'])->name('klapper.store');
// Route::get('/klapper/{id}', [KlapperController::class, 'showKlapper'])->name('klapper.siswa');
// Route::delete('/klapper/{id}', [KlapperController::class, 'deleteKlapper'])->name('klapper.delete');
// // Route::post('/klapper/{id}/siswa', [KlapperController::class, 'storeSiswa'])->name('siswa.store');

// // Routes untuk Siswa
// Route::get('/siswa', [KlapperController::class, 'indexSiswa'])->name('siswa.index');
// Route::get('/siswa/create', [KlapperController::class, 'createSiswa'])->name('siswa.create');
// Route::post('/siswa/{klappersId}', [KlapperController::class, 'storeSiswa'])->name('siswa.store');



Route::get('/klapper', [KlapperController::class, 'indexKlapper'])->name('klapper.index');
Route::get('/klapper/create', [KlapperController::class, 'createKlapper'])->name('klapper.create');
Route::post('/klapper', [KlapperController::class, 'storeKlapper'])->name('klapper.store');
Route::get('/klapper/{id}', [KlapperController::class, 'showKlapper'])->name('klapper.show');
Route::delete('/klapper/{id}', [KlapperController::class, 'deleteKlapper'])->name('klapper.delete');

Route::get('/klapper/{klapperId}/siswa', [KlapperController::class, 'indexSiswa'])->name('klapper.siswa');
Route::get('/klapper/{klapperId}/siswa/create', [KlapperController::class, 'createSiswa'])->name('siswa.create');
Route::post('/klapper/{klapperId}/siswa', [KlapperController::class, 'storeSiswa'])->name('siswa.store');