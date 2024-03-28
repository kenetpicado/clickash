<?php

use App\Http\Controllers\Clientarea\ClientareaController;
use App\Http\Controllers\Clientarea\InvoiceController;
use App\Http\Controllers\Clientarea\ProfileController as ClientareaProfileController;
use App\Http\Controllers\Clientarea\RaffleAvailabilityController;
use App\Http\Controllers\Clientarea\RaffleBlockedNumberController;
use App\Http\Controllers\Clientarea\RaffleController as ClientareaRaffleController;
use App\Http\Controllers\Clientarea\RaffleReportController;
use App\Http\Controllers\Clientarea\RaffleWinningNumberController;
use App\Http\Controllers\Clientarea\ResultController;
use App\Http\Controllers\Clientarea\SellerArchingController;
use App\Http\Controllers\Clientarea\SellerBlockedNumberController;
use App\Http\Controllers\Clientarea\SellerController;
use App\Http\Controllers\Clientarea\SellerReportController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\RaffleCloneController;
use App\Http\Controllers\Dashboard\RaffleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\UserRaffleAvailabilityController;
use App\Http\Controllers\Dashboard\UserRaffleController;
use App\Http\Controllers\Dashboard\UserSellerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)
    ->middleware(['auth:sanctum'])
    ->name('home');

Route::resource('profile', ProfileController::class)
    ->middleware(['auth:sanctum', 'online'])
    ->only(['index']);

Route::middleware(['auth:sanctum', 'online', 'role:root'])
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {
        Route::get('/', DashboardController::class)
            ->name('index');

        Route::resource('users', UserController::class)
            ->except(['edit', 'create']);

        Route::get('users/{user}/sellers', UserSellerController::class)
            ->name('users.sellers');

        Route::resource('users.raffles', UserRaffleController::class)
            ->only(['store', 'destroy']);

        Route::resource('users.raffles.availability', UserRaffleAvailabilityController::class)
            ->only(['index']);

        Route::resource('raffles', RaffleController::class)
            ->except(['edit', 'create', 'show']);

        Route::put('raffles/{raffle}/clone', RaffleCloneController::class)
            ->name('raffles.clone');
    });

Route::middleware(['auth:sanctum', 'online', 'role:owner', 'isMySeller'])
    ->prefix('clientarea')
    ->name('clientarea.')
    ->group(function () {
        Route::get('/', ClientareaController::class)
            ->name('index');

        Route::resource('profile', ClientareaProfileController::class)
            ->only(['index']);

        Route::resource('sellers', SellerController::class)
            ->only(['index', 'show']);

        Route::resource('sellers.archings', SellerArchingController::class)
            ->only(['index', 'store', 'destroy']);

        Route::get('sellers/{seller}/archings/{week}', [SellerArchingController::class, 'show'])
            ->name('sellers.archings.show');

        Route::get('sellers/{seller}/reports', SellerReportController::class)
            ->name('sellers.reports.index');

        Route::resource('sellers.blocked-numbers', SellerBlockedNumberController::class)
            ->only(['index', 'store', 'destroy']);

        Route::resource('raffles', ClientareaRaffleController::class)
            ->only(['index', 'show', 'update']);

        Route::resource('raffles.blocked-numbers', RaffleBlockedNumberController::class)
            ->only(['index', 'store', 'destroy']);

        Route::resource('raffles.availability', RaffleAvailabilityController::class)
            ->only(['index', 'store', 'update', 'destroy']);

        Route::resource('raffles.winning-numbers', RaffleWinningNumberController::class)
            ->only(['index', 'store', 'destroy']);

        Route::get('raffles/{raffle}/reports', RaffleReportController::class)
            ->name('raffles.reports');

        Route::resource('invoices', InvoiceController::class)
            ->only(['index', 'show']);

        Route::resource('results', ResultController::class)
            ->parameters(['results' => 'raffle'])
            ->only(['index', 'show']);
    });

Route::get('test', function () {
    return inertia('Test');
});
