<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use App\Models\Raffle;
use App\Models\RaffleUser;
use App\Models\Transaction;
use App\Models\WinningNumber;
use App\Services\BlockedNumberService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    public function index()
    {
        $raffles = RaffleUser::query()
            ->where('user_id', auth()->id())
            ->with('raffle:id,name')
            ->get();

        return inertia('Clientarea/Raffle/Index', [
            'raffles' => $raffles,
        ]);
    }

    public function show(Raffle $raffle)
    {
        $team = (new UserService)->getTeam();

        $transactions = Transaction::query()
            ->where('raffle_id', $raffle->id)
            ->whereIn('user_id', $team)
            ->with('user:id,name')
            ->latest('id')
            ->paginate();

        $availability = Availability::query()
            ->where('raffle_id', $raffle->id)
            ->where('user_id', auth()->id())
            ->orderBy('order')
            ->get(['id', 'day', 'order', 'blocked_hours', 'start_time', 'end_time']);

        $winningNumbers = WinningNumber::query()
            ->where('raffle_id', $raffle->id)
            ->where('user_id', auth()->id())
            ->where('date', now()->format('Y-m-d'))
            ->orderBy('hour')
            ->get(['id', 'number', 'hour']);

        $winners = [];

        $team = (new UserService)->getTeam();

        if ($winningNumbers->count() > 0) {
            $winners = Transaction::query()
                ->where('raffle_id', $raffle->id)
                ->whereIn('user_id', $team)
                ->where('created_at', '>=', Carbon::now()->format('Y-m-d 00:00:00'))
                ->where(function ($query) use ($winningNumbers) {
                    foreach ($winningNumbers as $winningNumber) {
                        $query->orWhere(function ($query) use ($winningNumber) {
                            $query->where('digit', $winningNumber->number)
                                ->where('hour', $winningNumber->hour);
                        });
                    }
                })
                ->with('user:id,name,last_login')
                ->orderBy('hour', 'desc')
                ->get();
        }

        return inertia('Clientarea/Raffle/Show', [
            'raffle' => $raffle,
            'transactions' => $transactions,
            'blockeds' => (new BlockedNumberService)->get($raffle->id),
            'availability' => $availability,
            'results' => $winningNumbers,
            'winners' => $winners,
        ]);
    }

    public function update(Request $request, $raffle)
    {
        RaffleUser::query()
            ->where('user_id', auth()->id())
            ->where('raffle_id', $raffle)
            ->update([
                'settings' => $request->settings,
            ]);

        return back();
    }
}
