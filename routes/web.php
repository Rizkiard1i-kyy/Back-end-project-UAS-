<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\HistoriNilaiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KalenderAkademikController;
use App\Http\Controllers\KsmController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\NilaiKHSController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\SuratKeteranganController;
use App\Http\Controllers\SuratPermohonanController;
use App\Http\Controllers\RpsController;
use App\Http\Controllers\UkmController;
use App\Http\Controllers\SkpiController;
use App\Http\Controllers\SkemaPembayaranController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\PengumumanController;

Route::get('/', function () {
    return view('/login');
});

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

Route::resource('historiNilai', HistoriNilaiController::class)
    ->middleware('auth');

Route::resource('jadwal', JadwalController::class)
    ->middleware('auth');

Route::resource('kalenderAkademik', KalenderAkademikController::class)
    ->middleware('auth');

Route::resource('ksm', KsmController::class)
    ->middleware('auth');

Route::resource('kehadiran', KehadiranController::class)
    ->middleware('auth');

Route::resource('nilaiKHS', NilaiKHSController::class)
    ->middleware('auth');
    
Route::resource('konsultasi', KonsultasiController::class)
    ->middleware('auth');

Route::resource('surat_keterangan', SuratKeteranganController::class);

Route::resource('surat_permohonan', SuratPermohonanController::class);

Route::resource('rps', RpsController::class)
    ->middleware('auth');

Route::resource('ukm', RpsController::class)
    ->middleware('auth');

Route::resource('skpi', UkmController::class)
    ->middleware('auth');

Route::resource('skema_pembayaran', SkemaPembayaranController::class)
    ->middleware('auth');

Route::resource('mataKuliah', MataKuliahController::class)
    ->middleware('auth');

Route::prefix('chatbot')
    ->name('chatbot.')
    ->group(function () {
        Route::get('/', [ChatBotController::class, 'index'])->name('index');
        Route::post('/ask', [ChatBotController::class, 'ask'])->name('ask');
        Route::get('/history', [ChatBotController::class, 'history'])->name('history');
        Route::delete('/clear', [ChatBotController::class, 'clear'])->name('clear');
    });

Route::resource('Pengumuman', PengumumanController::class)
    ->middleware('auth');
