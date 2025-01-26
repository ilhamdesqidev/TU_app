<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlapperController;
use App\Http\Controllers\TuController;
use App\Http\Controllers\SpensasiController;
use App\Http\Controllers\GuruController;

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

// Spen// Route manual untuk approve, reject, dan index
Route::get('superadmin/spensasi/tu', [TuController::class, 'index'])->name('superadmin.spensasi.tu.index');
Route::post('superadmin/spensasi/tu/approve/{id}', [TuController::class, 'approve'])->name('superadmin.spensasi.tu.approve');
Route::post('superadmin/spensasi/tu/reject/{id}', [TuController::class, 'reject'])->name('superadmin.spensasi.tu.reject');

// Resource route untuk operasi lainnya
Route::resource('tu', TuController::class)->except(['index']); // Menyertakan semua metode kecuali index


//super
Route::resource('spensasi', SpensasiController::class)->names([
    'index' => 'superadmin.spensasi.index',
    'create' => 'superadmin.spensasi.create',
    'store' => 'superadmin.spensasi.store',
    'edit' => 'superadmin.spensasi.edit',
    // 'update' => 'superadmin.spensasi.update',
    'destroy' => 'superadmin.spensasi.destroy'
]);

//guru
Route::resource('guru', GuruController::class);
Route::get('spensasi/guru', [GuruController::class, 'guruIndex'])->name('superadmin.spensasi.guru.index');