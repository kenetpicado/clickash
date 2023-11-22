<?php

use App\Http\Controllers\API\V1\ArchingController;
use App\Http\Controllers\API\V1\AuthenticatedSessionController;
use App\Http\Controllers\API\V1\BalanceController;
use App\Http\Controllers\API\V1\BulkTransaction;
use App\Http\Controllers\API\V1\DailySalesController;
use App\Http\Controllers\API\V1\ProfileController;
use App\Http\Controllers\API\V1\RaffleAvailabilityController;
use App\Http\Controllers\API\V1\RaffleBlockedNumberController;
use App\Http\Controllers\API\V1\RaffleController;
use App\Http\Controllers\API\V1\RaffleHourController;
use App\Http\Controllers\API\V1\RaffleWinningNumberController;
use App\Http\Controllers\API\V1\RaffleWinningTransactionController;
use App\Http\Controllers\API\V1\RegisterController;
use App\Http\Controllers\API\V1\ResumeController;
use App\Http\Controllers\API\V1\SellerController;
use App\Http\Controllers\API\V1\ToggleStatusController;
use App\Http\Controllers\API\V1\TransactionController;
use App\Http\Controllers\API\V1\TransactionMarkAsPaid;
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

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->name('login');

    Route::post('register', RegisterController::class)
        ->name('register');

    Route::middleware(['auth:sanctum', 'online', 'role:owner|seller'])->group(function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');

        Route::get('profile', [ProfileController::class, 'index'])
            ->name('profile.index');

        Route::put('profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::get('raffles', [RaffleController::class, 'index'])
            ->name('raffles.index');

        Route::apiResource('transactions', TransactionController::class)
            ->only(['index', 'store', 'destroy']);

        Route::post('bulk-transactions', BulkTransaction::class)
            ->name('bulk.transactions');

        Route::put('transactions/{transaction}/mark-as-paid', TransactionMarkAsPaid::class)
            ->name('transactions.mark-as-paid');

        Route::get('balance', BalanceController::class)
            ->name('balance');

        // Solo los dueños pueden acceder a estas rutas
        Route::group(['middleware' => ['role:owner']], function () {
            Route::put('toggle-status/{seller}', ToggleStatusController::class);

            Route::apiResource('sellers', SellerController::class);

            Route::put('raffles/{raffle}', [RaffleController::class, 'update'])
                ->name('raffles.update');

            Route::get('raffles/{raffle}', [RaffleController::class, 'show'])
                ->name('raffles.show');

            Route::apiResource('raffles.blocked-numbers', RaffleBlockedNumberController::class)
                ->only(['index', 'store', 'destroy']);

            Route::apiResource('raffles.winning-numbers', RaffleWinningNumberController::class)
                ->only(['index', 'store']);

            Route::get('raffles/{raffle}/winning-transactions', RaffleWinningTransactionController::class)
                ->name('raffles.winning-transactions.index');

            Route::apiResource('raffles.availability', RaffleAvailabilityController::class)
                ->only(['index', 'store', 'update', 'destroy']);

            Route::get('resume', ResumeController::class)
                ->name('resume.index');

            Route::get('raffles/{raffle}/daily-sales', DailySalesController::class)
                ->name('daily.sales');

            Route::get('raffles/{raffle}/hours', RaffleHourController::class)
                ->name('raffles.hours');

            Route::apiResource('archings', ArchingController::class)
                ->only(['index', 'store', 'destroy']);
        });
    });
});
