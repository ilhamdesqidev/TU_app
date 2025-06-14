<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlapperController;
use App\Http\Controllers\TuController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SuratmasukController;
use App\Http\Controllers\SuratkeluarController;
use App\Http\Controllers\IjazahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('main', function () {
    return view('main');
});

// Routes untuk Klapper
Route::get('/klapper', [KlapperController::class, 'indexKlapper'])->name('klapper.index');
Route::get('/klapper/create', [KlapperController::class, 'createKlapper'])->name('klapper.create');
Route::post('/klapper', [KlapperController::class, 'storeKlapper'])->name('klapper.store');
Route::get('/klapper/{id}', [KlapperController::class, 'showKlapper'])->name('klapper.show');
Route::delete('/klapper/{id}', [KlapperController::class, 'deleteKlapper'])->name('klapper.delete');

// Routes untuk Siswa
Route::get('/siswa', [SiswaController::class, 'indexSiswa'])->name('siswa.index');
Route::get('/siswa/create/{klappersId}', [SiswaController::class, 'createSiswa'])->name('siswa.create');
Route::post('/siswa/store/{klappersId}', [SiswaController::class, 'storeSiswa'])->name('siswa.store');
Route::get('/siswa/{id}', [SiswaController::class, 'showSiswa'])->name('siswa.show');
Route::get('/siswa/edit/{id}', [SiswaController::class, 'editSiswa'])->name('siswa.edit');
Route::put('/siswa/update/{id}', [SiswaController::class, 'updateSiswa'])->name('siswa.update');

Route::post('/klapper/{id}/luluskan', [SiswaController::class, 'luluskanSiswa'])->name('siswa.luluskan');
Route::post('/siswa/keluar/{id}', [SiswaController::class, 'keluar'])->name('siswa.keluar');
Route::post('/siswa/naik-kelas-xi/{id}', [SiswaController::class, 'naikKelasXI'])->name('siswa.naikKelasXI');
Route::post('/siswa/naik-kelas-xii/{id}', [SiswaController::class, 'naikKelasXII'])->name('siswa.naikKelasXII');

Route::get('/siswa/get-siswa/{nama_siswa}', [SiswaController::class, 'getSiswa'])->name('siswa.get');

//arsip
//surat masuk
Route::resource('surat_masuk', SuratmasukController::class);
Route::get('/surat_masuk/{id}/disposisi', [SuratMasukController::class, 'disposisi'])->name('surat_masuk.disposisi');
Route::get('surat_masuk/export', [SuratKeluarController::class, 'export'])->name('surat_masuk.export');
Route::get('surat_masuk/{id}/download/{index}', [SuratMasukController::class, 'downloadAttachment'])->name('surat_masuk.download_attachment');

//surat keluar
Route::resource('surat_keluar', SuratkeluarController::class);
Route::get('arsip/surat_keluar', [SuratkeluarController::class, 'surat_keluarIndex'])->name('arsip.surat_keluar.index');
// Route::post('/surat-keluar', [SuratKeluarController::class, 'store'])->name('surat_keluar.store');
// Route::get('/surat-keluar/{id}', [SuratKeluarController::class, 'show'])->name('surat_keluar.show');
Route::get('surat_keluar/export', [SuratKeluarController::class, 'export'])->name('surat_keluar.export');
Route::get('surat_keluar/{id}/download/{index}', [SuratKeluarController::class, 'downloadAttachment'])->name('surat_keluar.download_attachment');

//ijazah 
Route::resource('/ijazah', IjazahController::class);
Route::get('/ijazah/download/{id}', [IjazahController::class, 'download'])->name('ijazah.download');
Route::post('/ijazah/upload/{ijazah}', [IjazahController::class, 'upload'])->name('ijazah.upload');