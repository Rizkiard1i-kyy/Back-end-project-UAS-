<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\Akademik\HistoriNilaiController;
use App\Http\Controllers\Akademik\JadwalController;
use App\Http\Controllers\Akademik\KalenderAkademikController;
use App\Http\Controllers\Akademik\KehadiranController;
use App\Http\Controllers\Akademik\NilaiHasilController;
use App\Http\Controllers\Layanan_Mahasiswa\KonsultasiController;
use App\Http\Controllers\Layanan_Mahasiswa\SuratKeteranganController;
use App\Http\Controllers\Layanan_Mahasiswa\SuratPermohonanController;
use App\Http\Controllers\Bahan_Ajar\RpsController;
use App\Http\Controllers\Unit_Kegiatan_Mahasiswa\UkmController;
use App\Http\Controllers\SKPI\SkpiController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ChatBotController;
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

Route::resource('mataKuliah', MataKuliahController::class)
    ->middleware('auth');

Route::namespace('App\Http\Controllers\Akademik')->middleware(['auth'])->group(function () {
    Route::resource('historiNilai', 'HistoriNilaiController');
    Route::resource('jadwal', 'JadwalController');
    Route::resource('kalenderAkademik', 'KalenderAkademikController');
    Route::resource('kehadiran', 'KehadiranController');
    Route::resource('nilaiHasil', 'NilaiHasilController');
});
    
Route::namespace('App\Http\Controllers\Layanan_Mahasiswa')->middleware(['auth'])->group(function () {
    Route::resource('konsultasi', 'KonsultasiController');
    Route::resource('surat_keterangan', 'SuratKeteranganController');
    Route::resource('surat_permohonan', 'SuratPermohonanController');
});

Route::namespace('App\Http\Controllers\Bahan_Ajar')->middleware(['auth'])->group(function () {
    Route::resource('rps', 'RpsController');
});

Route::namespace('App\Http\Controllers\Unit_Kegiatan_Mahasiswa')->middleware(['auth'])->group(function () {
    Route::resource('ukm', 'UkmController');
});

Route::namespace('App\Http\Controllers\Uang_Kuliah')->middleware(['auth'])->group(function () {
    Route::resource('skema_pembayaran', 'SkemaPembayaranController');
    Route::resource('tagihan_pembayaran', 'TagihanPembayaranController');
});

Route::namespace('App\Http\Controllers\SKPI')->middleware(['auth'])->group(function () {
    Route::resource('skpi', 'SkpiController');
});

Route::resource('Pengumuman', PengumumanController::class)
    ->middleware('auth');

Route::middleware('auth')->prefix('chatbot')->name('chatbot.')->group(function () {
    Route::get('/', [ChatBotController::class, 'index'])->name('index');
    Route::post('/', [ChatBotController::class, 'store'])->name('store');
    Route::get('/history', [ChatBotController::class, 'history'])->name('history');
    Route::delete('/', [ChatBotController::class, 'destroy'])->name('destroy');
});

