<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UpdatePasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create']);

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');

    Route::resource('register', RegisterController::class)->only(['create', 'store']);
});

Route::middleware('auth')->group(function () {
    Route::put('password', UpdatePasswordController::class)->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
