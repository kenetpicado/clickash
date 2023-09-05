<?php

use App\Http\Controllers\API\V1\AuthenticatedSessionController;
use App\Http\Controllers\API\V1\ProfileController;
use App\Http\Controllers\API\V1\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(["prefix" => "v1"], function() {
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('users', [UserController::class, 'index'])->name('users.index');
    });
});
