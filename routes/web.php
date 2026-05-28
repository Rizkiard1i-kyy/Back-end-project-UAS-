<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\HistoriNilaiController;
use App\Http\Controllers\SuratKeteranganController;
use App\Http\Controllers\SkpiController;

Route::get('/', function () {
    return view('/login');
});

Route::resource('jadwal', JadwalController::class);

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::resource('pengguna', PenggunaController::class)
    ->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard', [
        'user' => auth()->user()
    ]);
})->middleware('auth');

Route::resource('kehadiran', KehadiranController::class);

Route::resource('historiNilai', HistoriNilaiController::class);
Route::resource('kehadiran', KehadiranController::class)
    ->middleware('auth');
Route::resource('surat_keterangan', SuratKeteranganController::class);

Route::resource('skpi', SkpiController::class);
