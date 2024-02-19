<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResultResource;
use App\Http\Resources\TransactionResource;
use App\Services\RaffleService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct(
        private readonly RaffleService $raffleService,
        private readonly TransactionService $transactionService
    ) {
    }

    public function index(Request $request)
    {
        $data = $this->raffleService->getResults($request->all());

        return ResultResource::collection($data['results'])->additional(['message' => $data['message']]);
    }

    public function show(Request $request, $raffle)
    {
        $data = $this->transactionService->getWinners($request->all(), $raffle);

        return TransactionResource::collection($data['transactions'])->additional(['message' => $data['message'],]);
    }
}
