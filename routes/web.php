<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlapperController;
use App\Http\Controllers\TuController;
use App\Http\Controllers\SpensasiController;
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

Route::post('/siswa/lulus/{id}', [SiswaController::class, 'lulusSemua'])->name('siswa.lulusSemua');
Route::post('/siswa/keluar/{id}', [SiswaController::class, 'keluar'])->name('siswa.keluar');
Route::post('/siswa/naik-kelas-xi/{id}', [SiswaController::class, 'naikKelasXI'])->name('siswa.naikKelasXI');
Route::post('/siswa/naik-kelas-xii/{id}', [SiswaController::class, 'naikKelasXII'])->name('siswa.naikKelasXII');

Route::get('/siswa/get-siswa/{nama_siswa}', [SiswaController::class, 'getSiswa'])->name('siswa.get');


//Resource route untuk operasi lainnya
Route::get('/tu', [TuController::class, 'index'])->name('tu.index');
Route::resource('tu', TuController::class)->except(['index']); // Menyertakan semua metode kecuali index
Route::post('superadmin/spensasi/tu/approve/{id}', [TuController::class, 'approve'])->name('superadmin.spensasi.tu.approve');
Route::post('superadmin/spensasi/tu/reject/{id}', [TuController::class, 'reject'])->name('superadmin.spensasi.tu.reject');

//super
Route::get('/spensasi/tu', [TuController::class, 'index'])->name('spensasi.tu.index');
Route::resource('spensasi', SpensasiController::class)->except(['show'])->names([
    'index' => 'superadmin.spensasi.index',
    'create' => 'superadmin.spensasi.create',
    'store' => 'superadmin.spensasi.store',
    'edit' => 'superadmin.spensasi.edit',
    'update' => 'superadmin.spensasi.update',
    'destroy' => 'superadmin.spensasi.destroy'
]);


//guru
Route::resource('guru', GuruController::class);
Route::get('spensasi/guru', [GuruController::class, 'index'])->name('superadmin.spensasi.guru.index');

//
Route::get('/getSiswa/{nama_siswa}', [KlapperController::class, 'getSiswa']);
Route::get('/searchSiswa', [SpensasiController::class, 'searchSiswa']);
Route::get('/superadmin/spensasi/searchSiswa', [SpensasiController::class, 'searchSiswa'])->name('superadmin.spensasi.searchSiswa');


//arsip
//surat masuk
Route::resource('surat_masuk', SuratmasukController::class);
Route::get('/surat_masuk/{id}/disposisi', [SuratMasukController::class, 'disposisi'])->name('surat_masuk.disposisi');
Route::get('surat_masuk/export', [SuratKeluarController::class, 'export'])->name('surat_masuk.export');
Route::get('surat_masuk/{id}/download/{index}', [SuratMasukController::class, 'downloadAttachment'])->name('surat_masuk.download_attachment');

//surat keluar
Route::resource('surat_keluar', SuratkeluarController::class);
Route::get('arsip/surat_keluar', [SuratkeluarController::class, 'surat_keluarIndex'])->name('superadmin.arsip.surat_keluar.index');
// Route::post('/surat-keluar', [SuratKeluarController::class, 'store'])->name('surat_keluar.store');
// Route::get('/surat-keluar/{id}', [SuratKeluarController::class, 'show'])->name('surat_keluar.show');
Route::get('surat_keluar/export', [SuratKeluarController::class, 'export'])->name('surat_keluar.export');
Route::get('surat_keluar/{id}/download/{index}', [SuratKeluarController::class, 'downloadAttachment'])->name('surat_keluar.download_attachment');


// Route::get('/ijazah', [IjazahController::class, 'index']);
// Route::get('/ijazah/create/{angkatan}', [IjazahController::class, 'create'])->name('ijazah.create');
// // index global dengan search
// Route::get('ijazah', [IjazahController::class,'index'])->name('ijazah.index');
// // lihat per angkatan (klapper)
// Route::get('ijazah/angkatan/{klapper}', [IjazahController::class,'perAngkatan'])->name('ijazah.perAngkatan');
// // CRUD
// Route::resource('ijazah', IjazahController::class)->except(['index','show']);
// Route::get('/ijazah/{ijazah}', [IjazahController::class, 'show'])->name('ijazah.show');

