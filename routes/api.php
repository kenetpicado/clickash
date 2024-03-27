<?php

use App\Http\Controllers\API\V1\AuthenticatedSessionController;
use App\Http\Controllers\API\V1\BulkTransaction;
use App\Http\Controllers\API\V1\InvoiceController;
use App\Http\Controllers\API\V1\ProfileController;
use App\Http\Controllers\API\V1\RaffleAvailabilityController;
use App\Http\Controllers\API\V1\RaffleBlockedNumberController;
use App\Http\Controllers\API\V1\RaffleController;
use App\Http\Controllers\API\V1\RaffleHourController;
use App\Http\Controllers\API\V1\RaffleReportListController;
use App\Http\Controllers\API\V1\RaffleWinningNumberController;
use App\Http\Controllers\API\V1\RegisterController;
use App\Http\Controllers\API\V1\ResultController;
use App\Http\Controllers\API\V1\SalesReportController;
use App\Http\Controllers\API\V1\SellerArchingController;
use App\Http\Controllers\API\V1\SellerController;
use App\Http\Controllers\API\V1\SellerWeekController;
use App\Http\Controllers\API\V1\TermAndConditionController;
use App\Http\Controllers\API\V1\ToggleStatusController;
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

Route::group(['prefix' => 'v1', 'as' => 'api.'], function () {
    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->name('login');

    Route::post('register', RegisterController::class)
        ->name('register');

    Route::get('terms-and-conditions', TermAndConditionController::class)
        ->name('terms-and-conditions');

    Route::middleware(['auth:sanctum', 'online', 'role:owner|seller', 'isMySeller'])->group(function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');

        Route::get('profile', [ProfileController::class, 'index'])
            ->name('profile.index');

        Route::put('profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::get('raffles', [RaffleController::class, 'index'])
            ->name('raffles.index');

        Route::get('raffles/{raffle}', [RaffleController::class, 'show'])
            ->name('raffles.show');

        Route::apiResource('invoices', InvoiceController::class)
            ->only(['index', 'show', 'destroy']);

        Route::post('bulk-transactions', BulkTransaction::class)
            ->name('bulk.transactions');

        Route::put('transactions/{transaction}/mark-as-paid', TransactionMarkAsPaid::class)
            ->name('transactions.mark-as-paid');

        Route::get('sellers/{seller}/archings', [SellerArchingController::class, 'index'])
            ->name('sellers.archings.index');

        Route::apiResource('sellers.weeks', SellerWeekController::class)
            ->only(['index', 'show']);

        Route::apiResource('results', ResultController::class)
            ->parameters(['results' => 'raffle'])
            ->only(['index', 'show']);

        Route::get('raffles/{raffle}/daily-sales', SalesReportController::class)
            ->name('raffles.reports.index');

        Route::get('raffles/{raffle}/hours', RaffleHourController::class)
            ->name('raffles.hours');

        Route::get('raffles-report-list', RaffleReportListController::class)
            ->name('raffles.report-list');

        // Solo los dueños pueden acceder a estas rutas
        Route::group(['middleware' => ['role:owner']], function () {
            Route::put('toggle-status/{seller}', ToggleStatusController::class)
                ->name('toggle-status');

            Route::apiResource('sellers', SellerController::class)
                ->except(['show']);

            Route::put('raffles/{raffle}', [RaffleController::class, 'update'])
                ->name('raffles.update');

            Route::apiResource('raffles.blocked-numbers', RaffleBlockedNumberController::class)
                ->only(['index', 'store', 'destroy']);

            Route::apiResource('raffles.winning-numbers', RaffleWinningNumberController::class)
                ->only(['index', 'store', 'destroy']);

            Route::apiResource('raffles.availability', RaffleAvailabilityController::class)
                ->only(['index', 'store', 'update', 'destroy']);

            Route::apiResource('sellers.archings', SellerArchingController::class)
                ->middleware('check.arching')
                ->only(['store', 'destroy']);

            Route::post('sellers/{seller}/weeks', [SellerWeekController::class, 'store']);
        });
    });
});
