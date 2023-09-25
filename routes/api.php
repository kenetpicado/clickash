<?php

use App\Http\Controllers\API\V1\AuthenticatedSessionController;
use App\Http\Controllers\API\V1\ProfileController;
use App\Http\Controllers\API\V1\RaffleAvailabilityController;
use App\Http\Controllers\API\V1\RaffleBlockedNumberController;
use App\Http\Controllers\API\V1\RaffleController;
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
    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->name('login');

    Route::post('register', RegisterController::class)
        ->name('register');

    Route::middleware(['auth:sanctum', 'role:owner|seller', 'online'])->group(function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');

        Route::get('profile', [ProfileController::class, 'index'])
            ->name('profile.index');

        Route::put('profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::get('raffles', [RaffleController::class, "index"])
            ->name('raffles.index');

        Route::get('raffles/{raffle}', [RaffleController::class, "show"])
            ->name('raffles.show');

        // Solo los dueños pueden acceder a estas rutas
        Route::group(['middleware' => ['role:owner']], function () {
            Route::put('toggle-status/{seller}', ToggleStatusController::class);

            Route::apiResource('sellers', SellerController::class)
                ->only(['index', 'store', 'update', 'destroy']);

            Route::put('raffles/{raffle}', [RaffleController::class, "update"])
                ->name('raffles.update');

            Route::apiResource('raffles.blocked-numbers', RaffleBlockedNumberController::class)
                ->only(['index', 'store', 'destroy']);

            Route::apiResource('raffles.availability', RaffleAvailabilityController::class)
                ->only(['index', 'store', 'update', 'destroy']);
        });
    });
});
