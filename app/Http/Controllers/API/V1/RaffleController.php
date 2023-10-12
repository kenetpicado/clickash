<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RaffleRequest;
use App\Http\Resources\RaffleResource;
use App\Http\Resources\TransactionResource;
use App\Repositories\RaffleUserRepository;
use App\Repositories\TransactionRepository;
use App\Services\RaffleService;

class RaffleController extends Controller
{
    public function __construct(
        private readonly RaffleUserRepository $raffleUserRepository,
        private readonly TransactionRepository $transactionRepository,
    ) {
    }

    public function index()
    {
        $raffles = [];

        if (auth()->user()->status == 'enabled') {
            $raffles = (new RaffleService)->getRaffles();
        }

        return RaffleResource::collection($raffles);
    }

    /*
    *   Get all transactions by raffle
    */
    public function show($raffle)
    {
        return TransactionResource::collection($this->transactionRepository->getTeamByRaffle($raffle));
    }

    public function update(RaffleRequest $request, $raffle)
    {
        $this->raffleUserRepository->updateSettings($raffle, $request->settings);

        return self::index();
    }
}
