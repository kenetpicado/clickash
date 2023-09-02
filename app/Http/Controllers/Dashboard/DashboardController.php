<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return inertia('Dashboard/Index', [
            'users_count' => User::whereNull('user_id')->count(),
            'sellers_count' => User::whereNotNull('user_id')->count()
        ]);
    }
}
