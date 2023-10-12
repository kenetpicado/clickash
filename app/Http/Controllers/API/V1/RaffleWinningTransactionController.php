<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Repositories\TransactionRepository;

class RaffleWinningTransactionController extends Controller
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository
    ) {
    }

    public function __invoke($raffle)
    {
        return TransactionResource::collection($this->transactionRepository->getWinnersByRaffle($raffle));
    }
}
