<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RaffleController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'online'])
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {
        Route::get('/', DashboardController::class)->name('index');

        Route::resource('profile', ProfileController::class)->only(['index', 'update']);

        Route::resource('users', UserController::class)->except(['edit', 'create']);

        Route::resource('raffles', RaffleController::class);
    });
