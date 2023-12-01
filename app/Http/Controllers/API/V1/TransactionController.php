<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
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

    public function destroy(Transaction $transaction)
    {
        $this->transactionService->destroy($transaction);

        return self::index();
    }
}
