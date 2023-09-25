<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Raffle;
use App\Models\RaffleUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserRaffleController extends Controller
{
    public function store(Request $request, User $user)
    {
        $raffle = Raffle::find($request->raffle_id);

        RaffleUser::updateOrCreate([
            'user_id' => $user->id,
            'raffle_id' => $raffle->id,
        ], [
            'settings' => $raffle->settings,
        ]);

        return back();
    }

    public function destroy(User $user, Raffle $raffle)
    {
        $user->raffles()->detach($raffle->id);

        return back();
    }
}
