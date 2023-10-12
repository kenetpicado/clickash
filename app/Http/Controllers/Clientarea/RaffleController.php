<?php

namespace App\Http\Controllers\Clientarea;

use App\Models\Raffle;
use App\Models\RaffleUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AvailabilityRepository;
use App\Repositories\BlockedNumberRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\WinningNumberRepository;

class RaffleController extends Controller
{
    public function __construct(
        private readonly AvailabilityRepository $availabilityRepository,
        private readonly BlockedNumberRepository $blockedNumberRepository,
        private readonly WinningNumberRepository $winningNumberRepository,
        private readonly TransactionRepository $transactionRepository,
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
        return inertia('Clientarea/Raffle/Show', [
            'raffle' => $raffle,
            'transactions' => $this->transactionRepository->getByRaffle($raffle->id),
            'blockeds' => $this->blockedNumberRepository->getByRaffle($raffle->id),
            'availability' => $this->availabilityRepository->getByRaffle($raffle->id),
            'results' => $this->winningNumberRepository->getByRaffle($raffle->id),
            'winners' => [],
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
