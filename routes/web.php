<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilUjianController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\SiswaAuthController;
use App\Http\Controllers\SiswaController;

Route::get('/', fn() => redirect()->route('siswa.login'));

// SISWA
Route::get('/login-siswa', [SiswaAuthController::class, 'index'])->name('siswa.login');
Route::post('/login-siswa', [SiswaAuthController::class, 'authenticate'])->name('siswa.login.submit');
Route::post('/logout-siswa', [SiswaAuthController::class, 'logout'])->name('siswa.logout');

Route::middleware('siswa.login')->group(function () {
    Route::get('/ujian', [UjianController::class, 'start'])->name('siswa.ujian');
    Route::get('/ujian/{nomor}', [UjianController::class, 'show'])->name('siswa.ujian.show');
    Route::post('/ujian/jawab', [UjianController::class, 'submit'])->name('siswa.ujian.submit');
    Route::post('/ujian/selesai', [UjianController::class, 'finish'])->name('siswa.ujian.finish');

    Route::get('/hasil-ujian', [HasilUjianController::class, 'index'])->name('siswa.hasil');
});

Route::middleware(['siswa.login', 'siswa.lulus'])->group(function () {
    Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('siswa.pendaftaran');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('siswa.pendaftaran.store');
});

// ADMIN
Route::prefix('admin')->group(function () {
    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', fn() => view('admin.login'))->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    });

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/siswa/export', [SiswaController::class, 'export'])->name('admin.siswa.export');
        Route::resource('siswa', SiswaController::class)->names('admin.siswa');
        
        Route::resource('soal', SoalController::class)->names('admin.soal');
    });
});

