<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class TransactionMarkAsPaid extends Controller
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository
    ) {
    }

    public function __invoke($transaction)
    {
        $this->transactionRepository->markAsPaid($transaction);

        return response()->json([
            'message' => 'Transaccion marcada como pagada'
        ]);
    }
}
