<?php

use App\Http\Controllers\API\V1\AuthenticatedSessionController;
use App\Http\Controllers\API\V1\ProfileController;
use App\Http\Controllers\API\V1\RaffleUserAvailabilityController;
use App\Http\Controllers\API\V1\RaffleUserBlockedNumberController;
use App\Http\Controllers\API\V1\RaffleUserController;
use App\Http\Controllers\API\V1\RegisterController;
use App\Http\Controllers\API\V1\SellerController;
use App\Http\Controllers\API\V1\ToggleStatusController;
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

Route::group(["prefix" => "v1"], function () {
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
    Route::post('register', RegisterController::class)->name('register');

    Route::middleware(['auth:sanctum', 'role:owner|seller', 'online'])->group(function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

        // Solo los dueños pueden acceder a estas rutas
        Route::group(['middleware' => ['role:owner']], function () {
            Route::put('toggle-status/{seller}', ToggleStatusController::class);

            Route::apiResource('sellers', SellerController::class)
                ->only(['index', 'store', 'update', 'destroy']);

            Route::apiResource('raffles', RaffleUserController::class)
                ->only(['index', 'update']);

            Route::apiResource('raffles.blocked-numbers', RaffleUserBlockedNumberController::class)
                ->parameters(['raffles' => 'raffle_user'])
                ->only(['index', 'store', 'destroy']);

            Route::apiResource('raffles.availability', RaffleUserAvailabilityController::class)
                ->parameters(['raffles' => 'raffle_user'])
                ->only(['index', 'store', 'update', 'destroy']);
        });
    });
});
