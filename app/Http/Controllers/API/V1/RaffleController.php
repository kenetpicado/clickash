<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\IntervalRequest;
use App\Http\Requests\API\RaffleRequest;
use App\Http\Resources\RaffleResource;
use App\Http\Resources\TransactionResource;
use App\Repositories\RaffleUserRepository;
use App\Services\RaffleService;
use App\Services\TransactionService;

class RaffleController extends Controller
{
    public function __construct(
        private readonly RaffleUserRepository $raffleUserRepository
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

    public function show(IntervalRequest $request, $raffle)
    {
        return TransactionResource::collection(
            (new TransactionService)->getInterval($request->validated(), $raffle)
        );
    }

    public function update(RaffleRequest $request, $raffle)
    {
        $this->raffleUserRepository->updateSettings($raffle, $request->settings);

        return self::index();
    }
}
