<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository,
    ) {
    }

    public function index(Request $request)
    {
        $requestArray = $request->all();

        return inertia('Clientarea/Transaction/Index', [
            'transactions' => fn() => $this->transactionRepository->getTeamTransactionsPerDay($requestArray),
            'daily_transactions' => fn() => $this->transactionRepository->getTeamTransactionsTotalPerDay($requestArray),
        ]);
    }
}
