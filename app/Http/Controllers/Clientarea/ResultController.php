<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResultResource;
use App\Http\Resources\TransactionResource;
use App\Models\Raffle;
use App\Repositories\TransactionRepository;
use App\Services\RaffleService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository,
        private readonly TransactionService $transactionService,
        private readonly RaffleService $raffleService
    ) {
    }

    // TODO: PENDING TO SHOW MESSAGE KEY
    public function index(Request $request)
    {
        $data = $this->raffleService->getResults($request->all());

        return inertia('Clientarea/Result/Index', [
            'results' => ResultResource::collection($data['results'])->resolve(),
        ]);
    }

    public function show(Request $request, Raffle $raffle)
    {
        $data = $this->transactionService->getWinners($request->all(), $raffle->id);

        return inertia('Clientarea/Result/Show', [
            'raffle' => $raffle,
            'transactions' => TransactionResource::collection($data['transactions'])->resolve(),
        ]);
    }
}
