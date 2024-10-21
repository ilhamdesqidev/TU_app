<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlapperController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('main', function () {
    return view('main');
});
Route::get('klapper', function () {
    return view('klapper');
});
Route::get('halaman-klapper', function () {
    return view('halaman-klapper');
});


Route::get('klapper', [KlapperController::class, 'index']);
Route::get('klapper/tambahdataklapper', [KlapperController::class, 'create']);
Route::post('klapper', [KlapperController::class, 'store']);
Route::delete('klapper/{id}', [KlapperController::class, 'delete']);
Route::get('klapper/{id}', [KlapperController::class, 'show'])->name('klapper.show');
// Tambahkan rute untuk show, edit, update sesuai kebutuhan

