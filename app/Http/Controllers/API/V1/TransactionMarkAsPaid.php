<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;

class TransactionMarkAsPaid extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService
    ) {
    }

    public function __invoke($transaction)
    {
        $this->transactionService->markAsPaid($transaction);

        return response()->json([
            'message' => 'Transaccion marcada como pagada',
        ]);
    }
}
