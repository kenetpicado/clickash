<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\UserService;

class TransactionController extends Controller
{
    public function index()
    {
        $userService = new UserService;

        $team = $userService->getTeam();

        return inertia('Clientarea/Transaction/Index', [
            'transactions' => Transaction::query()
                ->whereIn('user_id', $team)
                ->with(['user:id,name', 'raffle:id,name'])
                ->latest()
                ->paginate(),
        ]);
    }
}
