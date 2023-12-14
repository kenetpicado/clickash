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

    public function index()
    {
        return inertia('Clientarea/Transaction/Index', [
            'transactions' => $this->transactionRepository->getByTeam(),
            'daily_transactions' => $this->transactionRepository->getDailyTotalByTeam(),
        ]);
    }
}
