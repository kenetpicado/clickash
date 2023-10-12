<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Models\Raffle;
use App\Models\RaffleUser;
use App\Models\Transaction;
use App\Models\WinningNumber;
use App\Repositories\AvailabilityRepository;
use App\Repositories\BlockedNumberRepository;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    public function __construct(
        private readonly AvailabilityRepository $availabilityRepository,
        private readonly BlockedNumberRepository $blockedNumberRepository,
    ) {
    }

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

        $winningNumbers = WinningNumber::query()
            ->where('raffle_id', $raffle->id)
            ->where('user_id', auth()->id())
            ->where('date', now()->format('Y-m-d'))
            ->orderBy('hour')
            ->get(['id', 'number', 'hour']);

        $winners = [];

        if ($winningNumbers->count() > 0) {
            $winners = Transaction::query()
                ->where('raffle_id', $raffle->id)
                ->whereIn('user_id', $team)
                ->where('created_at', '>=', Carbon::now()->format('Y-m-d 00:00:00'))
                // ->where(function ($query) use ($winningNumbers) {
                //     foreach ($winningNumbers as $winningNumber) {
                //         $query->orWhere(function ($query) use ($winningNumber) {
                //             $query->where('digit', $winningNumber->number)
                //                 ->where('hour', $winningNumber->hour);
                //         });
                //     }
                // })
                ->with('user:id,name,last_login')
                ->orderBy('hour', 'desc')
                ->get();
        }

        return inertia('Clientarea/Raffle/Show', [
            'raffle' => $raffle,
            'transactions' => $transactions,
            'blockeds' => $this->blockedNumberRepository->getByRaffle($raffle->id),
            'availability' => $this->availabilityRepository->getByRaffle($raffle->id),
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
