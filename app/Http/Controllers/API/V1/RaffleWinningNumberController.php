<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\WinningNumberRequest;
use App\Http\Resources\WinningNumberResource;
use App\Models\WinningNumber;
use App\Services\WinningNumberService;
use Illuminate\Http\Request;

class RaffleWinningNumberController extends Controller
{
    public function __construct(
        private readonly WinningNumberService $winningNumberService,
    ) {
    }

    public function index(Request $request, $raffle)
    {
        return WinningNumberResource::collection($this->winningNumberService->getWinningNumbers($raffle, $request->all()));
    }

    public function store(WinningNumberRequest $request, $raffle)
    {
        try {
            $this->winningNumberService->store($request->validated(), $raffle);
        } catch (\Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return self::index(request(), $raffle);
    }

    public function destroy($raffle, WinningNumber $winningNumber)
    {
        try {
            $this->winningNumberService->destroy($winningNumber);
        } catch (\Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return self::index(request(), $raffle);
    }
}
