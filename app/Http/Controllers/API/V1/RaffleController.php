<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UpdateSettingsRequest;
use App\Http\Resources\RaffleResource;
use App\Services\RaffleService;

class RaffleController extends Controller
{
    public function __construct(
        private readonly RaffleService $raffleService,
    ) {
    }

    public function index()
    {
        return RaffleResource::collection($this->raffleService->getAssignedRafflesWithAvailability(auth()->user()->getOwnerId()));
    }

    public function show($raffle)
    {
        return RaffleResource::make($this->raffleService->getRaffle($raffle))->resolve();
    }

    public function update(UpdateSettingsRequest $request, $raffle)
    {
        $this->raffleService->updateUserSettings($raffle, $request->settings);

        return self::index();
    }
}
