<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\BlockedNumberRequest;
use App\Http\Resources\BlockedNumberResource;
use App\Models\BlockedNumber;
use App\Services\BlockedNumberService;

class RaffleBlockedNumberController extends Controller
{
    public function __construct(
        private readonly BlockedNumberService $blockedNumberService
    ) {
    }

    public function index($raffle)
    {
        return BlockedNumberResource::collection($this->blockedNumberService->getRaffleBlockedNumbers($raffle));
    }

    public function store(BlockedNumberRequest $request, $raffle)
    {
        $this->blockedNumberService->store($request->validated());

        return self::index($raffle);
    }

    public function destroy($raffle, BlockedNumber $blockedNumber)
    {
        $blockedNumber->delete();

        return self::index($raffle);
    }
}
