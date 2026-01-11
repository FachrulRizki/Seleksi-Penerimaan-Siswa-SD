<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\{
  SoalController, UjianController, AdminAuthController, DashboardController,
  GuruAuthController, GuruController, GuruJadwalController, GuruKelasController,
  HasilUjianController, JadwalPelajaranController, KelasController, MapelController,
  PendaftaranController, PendaftaranSeleksiController, SiswaAktifController,
  SiswaAuthController, SiswaController
};

Route::get('/', fn() => view('landing'))->name('landing');

/*
|--------------------------------------------------------------------------
| PESERTA UJIAN (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::prefix('peserta')->name('peserta.')->group(function () {
    Route::get('/daftar', [PendaftaranSeleksiController::class, 'create'])->name('daftar');
    Route::post('/daftar', [PendaftaranSeleksiController::class, 'store'])->name('daftar.store');

    Route::get('/login', [SiswaAuthController::class, 'index'])->name('login');
    Route::post('/login', [SiswaAuthController::class, 'authenticate'])->name('login.submit');
    Route::post('/logout', [SiswaAuthController::class, 'logout'])->name('logout');

    Route::middleware('peserta.login')->group(function () {
        Route::get('/ujian', [UjianController::class, 'start'])->name('ujian');
        Route::get('/ujian/{nomor}', [UjianController::class, 'show'])->name('ujian.show');
        Route::post('/ujian/jawab', [UjianController::class, 'submit'])->name('ujian.submit');
        Route::post('/ujian/selesai', [UjianController::class, 'finish'])->name('ujian.finish');

        Route::get('/hasil', [HasilUjianController::class, 'index'])->name('hasil');

        Route::middleware('peserta.lulus')->group(function () {
            Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran');
            Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
        });
    });
});

/*
|--------------------------------------------------------------------------
| LOGIN GABUNGAN (ADMIN/GURU)
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    if (Auth::guard('admin')->check()) return redirect()->route('admin.dashboard');
    if (Auth::guard('guru')->check())  return redirect()->route('guru.dashboard');
    return view('admin.login', ['role' => 'admin']);
})->name('login');

Route::post('/login/admin', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/login/guru', [GuruAuthController::class, 'login'])->name('guru.login.submit');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('/peserta/export', [SiswaController::class, 'export'])->name('peserta.export');
        Route::resource('peserta', SiswaController::class)->names('peserta');
        Route::resource('soal', SoalController::class)->names('soal');

        Route::resource('guru', GuruController::class)->names('guru')->except('show');
        Route::resource('kelas', KelasController::class)->names('kelas')->except('show');
        Route::resource('siswa', SiswaAktifController::class)->names('siswa')->except('show');

        Route::resource('mapel', MapelController::class)->names('mapel')->except('show','create','edit');
        Route::resource('jadwal', JadwalPelajaranController::class)->names('jadwal')->except('show');
    });
});

/*
|--------------------------------------------------------------------------
| GURU
|--------------------------------------------------------------------------
*/
Route::prefix('guru')->name('guru.')->group(function () {
    Route::middleware('guru.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [GuruAuthController::class, 'logout'])->name('logout');

        Route::get('/jadwal', [GuruJadwalController::class, 'index'])->name('jadwal');
        Route::get('/kelas', [GuruKelasController::class, 'index'])->name('kelas.index');
        Route::get('/kelas/{kelas}', [GuruKelasController::class, 'show'])->name('kelas.show');
    });
});
