<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Raffle;
use App\Models\User;
use Illuminate\Http\Request;

class UserRaffleAvailabilityController extends Controller
{
    public function index(Request $request, User $user, Raffle $raffle)
    {
        $availability = $user->availability()
            ->where('raffle_id', $raffle->id)
            ->orderBy('order')
            ->get(['id', 'user_id', 'raffle_id', 'day', 'order', 'start_time', 'end_time', 'blocked_hours']);

        return inertia('Dashboard/User/Raffle/Availability', [
            'user' => $user,
            'raffle' => $raffle,
            'availability' => $availability,
        ]);
    }
}
