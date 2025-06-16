<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlapperController;
use App\Http\Controllers\TuController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SuratMasukController;
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

// Route resource utama untuk Surat Masuk
Route::resource('surat_masuk', SuratMasukController::class);

// Route khusus untuk modal disposisi
Route::get('surat_masuk/{suratMasuk}/disposisi', [SuratMasukController::class, 'disposisi'])
    ->name('surat_masuk.disposisi');
    
Route::post('surat_masuk/{suratMasuk}/disposisi', [SuratMasukController::class, 'storeDisposisi'])
    ->name('surat_masuk.disposisi.store');
    
Route::get('surat_masuk/{suratMasuk}/print', [SuratMasukController::class, 'print'])
    ->name('surat_masuk.print');
    
Route::get('surat_masuk/export', [SuratMasukController::class, 'export'])
    ->name('surat_masuk.export');

// Route untuk Surat Keluar
Route::resource('surat_keluar', SuratkeluarController::class);
Route::get('surat_keluar/export', [SuratkeluarController::class, 'export'])->name('surat_keluar.export');
Route::get('surat_keluar/{id}/download/{index}', [SuratkeluarController::class, 'downloadAttachment'])->name('surat_keluar.download_attachment');

// Route untuk Ijazah
Route::resource('/ijazah', IjazahController::class);
Route::get('/ijazah/download/{id}', [IjazahController::class, 'download'])->name('ijazah.download');
Route::post('/ijazah/upload/{ijazah}', [IjazahController::class, 'upload'])->name('ijazah.upload');