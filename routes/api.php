<?php

use App\Http\Controllers\API\V1\AuthenticatedSessionController;
use App\Http\Controllers\API\V1\ProfileController;
use App\Http\Controllers\API\V1\RaffleController;
use App\Http\Controllers\API\V1\RegisterController;
use App\Http\Controllers\API\V1\SellerController;
use App\Http\Controllers\API\V1\StatusController;
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
    Route::post('register', RegisterController::class)->name('register');

    Route::middleware(['auth:sanctum', 'role:owner|seller', 'online'])->group(function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

        // Solo los dueños pueden crear, editar y eliminar vendedores
        Route::apiResource('sellers', SellerController::class)->middleware(['role:owner']);

        Route::get('raffles', RaffleController::class)->name('raffles.index');

        Route::get('status', StatusController::class)->middleware(['role:owner']);
    });
});
