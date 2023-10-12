<?php

namespace App\Http\Controllers\API\V1;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Resources\WinningNumberResource;
use App\Repositories\WinningNumberRepository;
use App\Http\Requests\API\WinningNumberRequest;

class RaffleWinningNumberController extends Controller
{
    public function __construct(
        private readonly WinningNumberRepository $winningNumberRepository
    ) {
    }

    public function index($raffle)
    {
        return WinningNumberResource::collection($this->winningNumberRepository->getByRaffle($raffle, true));
    }

    public function store(WinningNumberRequest $request, $raffle)
    {
        if (Carbon::parse($request->hour)->isFuture()) {
            abort(403, 'No puedes registrar una turno que no ha pasado');
        }

        $this->winningNumberRepository->store($request->validated(), $raffle);

        return self::index($raffle);
    }
}
