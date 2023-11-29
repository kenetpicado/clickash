<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\ArchingRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class SellerBalanceController extends Controller
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository,
        private readonly ArchingRepository $archingRepository,
    ) {
    }

    public function __invoke(Request $request, User $user)
    {
        $balance = $this->transactionRepository->getBalanceByUser($user->id, $request->all());

        $resume = $this->archingRepository->getTotalArchingsBySeller($user->id, $request->all());

        $balance->income = $balance->income + $resume->deposit - $resume->withdrawal;
        $balance->balance = $balance->income - $balance->expenditure;

        return inertia('Clientarea/Seller/Balance', [
            'balance' => $balance,
            'seller' => $user,
            'archings' => $this->archingRepository->getArchingsBySeller($user->id, $request->all()),
        ]);
    }
}
