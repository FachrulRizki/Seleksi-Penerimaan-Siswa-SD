<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\StudentAuthController;

Route::get('/', fn() => redirect('/login-student'));

// STUDENT
Route::get('/login-student', fn() => view('student.login'));
Route::post('/login-student', [StudentAuthController::class, 'login']);

Route::middleware('student')->group(function () {
    Route::get('/student/ujian', [UjianController::class, 'index']);
    Route::post('/student/ujian', [UjianController::class, 'submit']);
    Route::get('/student/registrasi', [RegistrasiController::class, 'index']);
    Route::post('/student/registrasi', [RegistrasiController::class, 'store']);
});

// ADMIN
Route::get('/admin/login', fn() => view('admin.login'));
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'));
    Route::get('/admin/report', [AdminController::class, 'report']);

    Route::get('/admin/soal', [SoalController::class, 'index']);
    Route::get('/admin/soal/create', [SoalController::class, 'create']);
    Route::post('/admin/soal', [SoalController::class, 'store']);
});
