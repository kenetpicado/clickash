<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository,
        private readonly TransactionService $transactionService
    ) {
    }

    public function index(Request $request)
    {
        $filters = $request->all();

        if (auth()->user()->isSeller())
            $data = $this->transactionRepository->getUserTransactionsPerDay(auth()->id(), $filters);
        else
            $data = $this->transactionRepository->getTeamTransactionsPerDay($filters);

        return TransactionResource::collection($data);
    }

    public function destroy(Transaction $transaction)
    {
        $this->transactionService->destroy($transaction);

        return self::index(request());
    }
}
