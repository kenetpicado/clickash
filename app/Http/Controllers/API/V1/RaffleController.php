<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\IntervalRequest;
use App\Http\Requests\API\RaffleRequest;
use App\Http\Resources\RaffleResource;
use App\Http\Resources\RaffleTransactionResource;
use App\Models\RaffleUser;
use App\Services\RaffleService;

class RaffleController extends Controller
{
    public function index()
    {
        return RaffleResource::collection((new RaffleService)->getRaffles());
    }

    public function show(IntervalRequest $request, $raffle)
    {
        return RaffleTransactionResource::collection((new RaffleService)->getTransactions($raffle, $request->validated()));
    }

    public function update(RaffleRequest $request, $raffle)
    {
        RaffleUser::where('raffle_id', $raffle)
            ->where('user_id', auth()->id())
            ->update([
                'settings' => $request->settings,
            ]);

        return self::index();
    }
}
