<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Raffle;
use App\Models\User;
use Illuminate\Http\Request;

class UserRaffleController extends Controller
{
    public function index(User $user)
    {
        return inertia('Dashboard/User/Raffle/Index', [
            'user' => $user->load('raffles'),
            'raffles' => Raffle::all(['id', 'name'])
        ]);
    }

    public function store(Request $request, User $user)
    {
        $user->raffles()->syncWithoutDetaching($request->raffle_id);

        return back();
    }

    public function destroy(User $user, Raffle $raffle)
    {
        $user->raffles()->detach($raffle->id);

        return back();
    }
}
