<?php

use App\Http\Controllers\Clientarea\ClientareaController;
use App\Http\Controllers\Clientarea\ProfileController as ClientareaProfileController;
use App\Http\Controllers\Clientarea\RaffleAvailabilityController;
use App\Http\Controllers\Clientarea\RaffleBlockedNumberController;
use App\Http\Controllers\Clientarea\RaffleController as ClientareaRaffleController;
use App\Http\Controllers\Clientarea\RaffleWinningNumberController;
use App\Http\Controllers\Clientarea\SellerController;
use App\Http\Controllers\Clientarea\ToggleStatusController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\RaffleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\UserRaffleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)
    ->middleware(['auth:sanctum'])
    ->name('home');

Route::middleware(['auth:sanctum', 'online', 'role:root'])
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {
        Route::get('/', DashboardController::class)
            ->name('index');

        Route::resource('users', UserController::class)
            ->except(['edit', 'create']);

        Route::resource('users.raffles', UserRaffleController::class)
            ->only(['store', 'destroy']);

        Route::resource('raffles', RaffleController::class)
            ->except(['edit', 'create', 'show']);
    });

Route::middleware(['auth:sanctum', 'online', 'role:owner'])
    ->prefix('clientarea')
    ->name('clientarea.')
    ->group(function () {
        Route::get('/', ClientareaController::class)
            ->name('index');

        Route::resource('profile', ClientareaProfileController::class)->only(['index', 'update']);

        Route::resource('sellers', SellerController::class)
            ->except(['index', 'edit', 'create']);

        Route::put('toggle-status/{seller}', ToggleStatusController::class)->name('toggle-status');

        Route::resource('raffles', ClientareaRaffleController::class)
            ->only(['show', 'update']);

        Route::resource('raffles.blocked-numbers', RaffleBlockedNumberController::class)
            ->only(['store', 'destroy']);

        Route::resource('raffles.availability', RaffleAvailabilityController::class)
            ->only(['store', 'update', 'destroy']);

        Route::resource('raffles.winning-numbers', RaffleWinningNumberController::class)
            ->only(['store']);
    });

Route::middleware(['auth:sanctum', 'online'])
    ->group(function () {
        Route::resource('profile', ProfileController::class)->only(['index', 'update']);
    });
