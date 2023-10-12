<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use App\Http\Resources\TransactionResource;
use App\Repositories\TransactionRepository;
use App\Http\Requests\API\TransactionRequest;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository,
        private readonly TransactionService $transactionService
    ) {
    }

    public function index()
    {
        return TransactionResource::collection($this->transactionRepository->getToday());
    }

    public function store(TransactionRequest $request)
    {
        $transaction = $this->transactionService->store($request->validated());

        return TransactionResource::make($transaction);
    }
}
