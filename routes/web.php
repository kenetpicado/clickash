<?php

use App\Http\Controllers\Clientarea\ClientareaController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\RaffleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\UserRaffleController;
use App\Http\Controllers\HomeController;
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

// Route::redirect('', '/dashboard');

Route::get("/", HomeController::class)
    ->middleware(['auth:sanctum'])
    ->name('home');

// ONLY ROO USERS
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

// ONLY OWNERS USERS
Route::middleware(['auth:sanctum', 'online', 'role:owner'])
    ->prefix('clientarea')
    ->name('clientarea.')
    ->group(function () {
        Route::get('/', ClientareaController::class)
            ->name('index');
    });

//ANY USER
Route::middleware(['auth:sanctum', 'online'])
    ->group(function () {
        Route::resource('profile', ProfileControlleR::class)->only(['index', 'update']);
    });
