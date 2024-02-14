<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\BlockedNumberRequest;
use App\Models\BlockedNumber;
use App\Models\User;
use App\Repositories\RaffleRepository;
use Illuminate\Http\Request;

class SellerBlockedNumberController extends Controller
{
    public function __construct(
        private readonly RaffleRepository $raffleRepository
    ) {
    }

    public function index(Request $request, User $seller)
    {
        if ($request->raffle_id) {
            $blockeds = $seller->blockedNumbers()
                ->where('raffle_id', $request->raffle_id)
                ->orderBy('number')
                ->get();
        }

        return inertia('Clientarea/Seller/BlockedNumber/Index', [
            'seller' => $seller,
            'raffles' => $this->raffleRepository->getRafflesNames(),
            'blockeds' => fn () => $blockeds ?? [],
        ]);
    }

    public function store(BlockedNumberRequest $request, User $seller)
    {
        $seller->blockedNumbers()->create($request->validated());

        return back();
    }

    public function destroy($seller, BlockedNumber $blockedNumber)
    {
        $blockedNumber->delete();

        return back();
    }
}
