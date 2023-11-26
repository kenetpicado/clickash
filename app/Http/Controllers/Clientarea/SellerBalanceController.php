<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class SellerBalanceController extends Controller
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository
    ) {
    }

    public function __invoke(Request $request, User $user)
    {
        $balance = $this->transactionRepository->getBalanceByUser($user->id, $request->all());

        return inertia('Clientarea/Seller/Balance', [
            'balance' => $balance,
            'seller' => $user,
        ]);
    }
}
