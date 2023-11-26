<?php

namespace App\Providers;

use App\Models\Raffle;
use App\Models\RaffleUser;
use App\Models\User;
use App\Observers\RaffleObserver;
use App\Observers\RaffleUserObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Raffle::observe(RaffleObserver::class);
        RaffleUser::observe(RaffleUserObserver::class);
    }
}
