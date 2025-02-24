<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlapperController;
use App\Http\Controllers\TuController;
use App\Http\Controllers\SpensasiController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SuratmasukController;
use App\Http\Controllers\SuratkeluarController;

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
Route::get('/siswa/{id}/keluar', [KlapperController::class, 'keluar'])->name('klapper.keluar');
Route::post('/klapper/{id}/luluskan', [KlapperController::class, 'lulusSemua'])->name('klapper.lulusSemua');
Route::post('/klapper/{id}/naik-kelas-xi', [KlapperController::class, 'naikKelasXI'])->name('klapper.naikKelasXI');
Route::post('/klapper/{id}/naik-kelas-xii', [KlapperController::class, 'naikKelasXII'])->name('klapper.naikKelasXII');

//Resource route untuk operasi lainnya
Route::get('/tu', [TuController::class, 'index'])->name('tu.index');
Route::resource('tu', TuController::class)->except(['index']); // Menyertakan semua metode kecuali index
Route::post('superadmin/spensasi/tu/approve/{id}', [TuController::class, 'approve'])->name('superadmin.spensasi.tu.approve');
Route::post('superadmin/spensasi/tu/reject/{id}', [TuController::class, 'reject'])->name('superadmin.spensasi.tu.reject');

//super
Route::resource('spensasi', SpensasiController::class)->names([
    'index' => 'superadmin.spensasi.index',
    'create' => 'superadmin.spensasi.create',
    'store' => 'superadmin.spensasi.store',
    'edit' => 'superadmin.spensasi.edit',
    'update' => 'superadmin.spensasi.update',
    'destroy' => 'superadmin.spensasi.destroy'
]);

//guru
Route::resource('guru', GuruController::class);
Route::get('spensasi/guru', [GuruController::class, 'guruIndex'])->name('superadmin.spensasi.guru.index');

//
Route::get('/getSiswa/{nama_siswa}', [KlapperController::class, 'getSiswa']);
Route::get('/searchSiswa', [SpensasiController::class, 'searchSiswa']);
Route::get('/superadmin/spensasi/searchSiswa', [SpensasiController::class, 'searchSiswa'])->name('superadmin.spensasi.searchSiswa');


//arsip
//surat masuk
Route::middleware(['web'])->group(function () {
    Route::resource('surat_masuk', SuratmasukController::class)->names([
        'index' => 'arsip.surat_masuk.index',
        'create' => 'arsip.surat_masuk.create',
        'store' => 'arsip.surat_masuk.store',
        'show' => 'arsip.surat_masuk.show',
        'edit' => 'arsip.surat_masuk.edit',
        'update' => 'arsip.surat_masuk.update',
        'destroy' => 'arsip.surat_masuk.destroy',
    ]);
});

//surat keluar
Route::resource('surat_keluar', SuratkeluarController::class);
Route::get('arsip/surat_keluar', [SuratkeluarController::class, 'surat_keluarIndex'])->name('superadmin.arsip.surat_keluar.index');
