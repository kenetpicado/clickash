<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clientarea\SellerArchingRequest;
use App\Models\Arching;
use App\Models\User;
use App\Repositories\ArchingRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class SellerArchingController extends Controller
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository,
        private readonly ArchingRepository $archingRepository,
    ) {
    }

    public function index(Request $request, User $seller)
    {
        $cashbox = $this->transactionRepository->getCashboxByUser($seller->id, $request->all());

        $resume = $this->archingRepository->getTotalArchingsBySeller($seller->id, $request->all());

        $cashbox->revenue = ($cashbox->income - $cashbox->expenditure) + $resume->deposit - $resume->withdrawal;

        return inertia('Clientarea/Seller/Arching/Index', [
            'cashbox' => $cashbox,
            'seller' => $seller,
            'archings' => $this->archingRepository->getArchingsBySeller($seller->id, $request->all()),
        ]);
    }

    public function store(SellerArchingRequest $request, $seller)
    {
        Arching::create($request->validated() + [
            'user_id' => auth()->id(),
            'seller_id' => $seller,
            'current_balance' => 0,
        ]);

        return back();
    }

    public function destroy($seller, $arching)
    {
        Arching::where('id', $arching)->delete();

        return back();
    }
}
