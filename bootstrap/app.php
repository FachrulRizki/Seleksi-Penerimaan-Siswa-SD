<?php

use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\AdminGuest;
use App\Http\Middleware\GuruAuth;
use App\Http\Middleware\GuruGuest;
use App\Http\Middleware\SiswaLogin;
use App\Http\Middleware\SiswaLulus;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'peserta.login' => SiswaLogin::class,
            'peserta.lulus' => SiswaLulus::class,
            'admin.auth' => AdminAuth::class,
            'admin.guest' => AdminGuest::class,
            'guru.auth' => GuruAuth::class,
            'guru.guest' => GuruGuest::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
