<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\BlockedNumberRequest;
use App\Models\BlockedNumber;
use App\Models\User;
use App\Services\BlockedNumberService;
use App\Services\RaffleService;
use Illuminate\Http\Request;

class SellerBlockedNumberController extends Controller
{
    public function __construct(
        private readonly BlockedNumberService $blockedNumberService,
        private readonly RaffleService $raffleService
    ) {
    }

    public function index(Request $request, User $seller)
    {
        return inertia('Clientarea/Seller/BlockedNumber/Index', [
            'seller' => $seller,
            'raffles' => $this->raffleService->getRaffleNames(),
            'blockeds' => $this->blockedNumberService->getUserBlockedNumbers($seller->id, $request->get('raffle_id')),
        ]);
    }

    public function store(BlockedNumberRequest $request, $seller)
    {
        try {
            $this->blockedNumberService->store($request->validated(), $seller);
        } catch (\Exception $e) {
            return back()->withErrors(['message' => $e->getMessage()]);
        }

        return back();
    }

    public function destroy($seller, BlockedNumber $blockedNumber)
    {
        $blockedNumber->delete();

        return back();
    }
}
