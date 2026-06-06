<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\HistoriNilaiController;
use App\Http\Controllers\SuratKeteranganController;
use App\Http\Controllers\SkpiController;
use App\Http\Controllers\KsmController;
use App\Http\Controllers\NilaiKHSController;
use App\Http\Controllers\SuratPermohonanController;
use App\Http\Controllers\SkemaPembayaranController;
use App\Http\Controllers\KonsultasiController;

Route::get('/', function () {
    return view('/login');
});

Route::resource('jadwal', JadwalController::class);

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::resource('pengguna', PenggunaController::class)
    ->middleware('role:admin');

Route::get('/dashboard', function () {
    return view('dashboard', [
        'user' => auth()->user()
    ]);
})->middleware('auth');

Route::resource('kehadiran', KehadiranController::class);

Route::resource('historiNilai', HistoriNilaiController::class);
Route::resource('nilaiKHS', NilaiKHSController::class)->middleware('auth');
Route::resource('kehadiran', KehadiranController::class)
    ->middleware('auth');
Route::resource('surat_keterangan', SuratKeteranganController::class);
Route::resource('surat_permohonan', SuratPermohonanController::class);

Route::resource('skpi', SkpiController::class);

Route::resource('ksm', KsmController::class)->middleware('auth');

Route::resource('skema_pembayaran', SkemaPembayaranController::class)->middleware('auth');

Route::resource('konsultasi', KonsultasiController::class)->middleware('auth');