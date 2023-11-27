<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserSellerController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        return inertia('Dashboard/User/Sellers', [
            'user' => $user,
            'sellers' => $user->sellers()->get(),
        ]);
    }
}
