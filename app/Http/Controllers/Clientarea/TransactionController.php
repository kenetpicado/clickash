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
        return inertia('Clientarea/Transaction/Index', [
            'transactions' => $this->transactionRepository->getTeamTransactionsPerDay(),
            'daily_transactions' => $this->transactionRepository->getTeamTotalOfTheDay($request->all()),
        ]);
    }
}
