<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Repositories\TransactionRepository;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository,
        private readonly TransactionService $transactionService
    ) {
    }

    public function index()
    {
        return TransactionResource::collection($this->transactionRepository->getMyDaily());
    }

    public function store(TransactionRequest $request)
    {
        $transaction = $this->transactionService->store($request->validated());

        return TransactionResource::make($transaction);
    }
}
