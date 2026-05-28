<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KehadiranController;

Route::get('/', function () {
    return view('/login');
});

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