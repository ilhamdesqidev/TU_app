<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlapperController;
use App\Http\Controllers\TuController;
use App\Http\Controllers\SpensasiController;

Route::get('superadmin/welcome', function () {
    return view('welcome');
});
Route::get('main', function () {
    return view('main');
});

Route::get('/klapper', [KlapperController::class, 'indexKlapper'])->name('klapper.index');
Route::get('/klapper/tambahdataklapper', [KlapperController::class, 'createKlapper'])->name('klapper.create');
Route::post('/klapper', [KlapperController::class, 'storeKlapper'])->name('klapper.store');
Route::get('/klapper/{id}', [KlapperController::class, 'showKlapper'])->name('klapper.show');
Route::delete('/klapper/{id}', [KlapperController::class, 'deleteKlapper'])->name('klapper.delete');

Route::get('/klapper/{klapperId}', [KlapperController::class, 'indexSiswa'])->name('klapper.siswa');
Route::get('klapper/{id}/siswa/create', [KlapperController::class, 'createSiswa'])->name('siswa.create');
Route::post('klapper/{id}/siswa', [KlapperController::class, 'storeSiswa'])->name('siswa.store');
Route::get('/siswa/{id}', [KlapperController::class, 'showSiswa'])->name('siswa.show');
Route::get('siswa/{id}/edit', [KlapperController::class, 'editSiswa'])->name('siswa.edit');
Route::put('siswa/{id}', [KlapperController::class, 'updateSiswa'])->name('siswa.update');

Route::get('/', [KlapperController::class, 'index'])->name('welcome');
Route::get('/siswa/lulus/{id}', [KlapperController::class, 'lulus'])->name('klapper.lulus');
Route::get('/siswa/{id}/keluar', [KlapperController::class, 'keluar'])->name('klapper.keluar');
Route::post('/klapper/{klapper}/lulusSemua', [KlapperController::class, 'lulusSemua'])->name('klapper.lulusSemua');

Route::post('/klapper/{id}/naik-kelas-xi', [KlapperController::class, 'naikKelasXI'])->name('klapper.naikKelasXI');
Route::post('/klapper/{id}/naik-kelas-xii', [KlapperController::class, 'naikKelasXII'])->name('klapper.naikKelasXII');

// Spen
Route::resource('tu', TuController::class);

Route::resource('spensasi', SpensasiController::class);