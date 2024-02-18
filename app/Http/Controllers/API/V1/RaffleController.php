<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UpdateSettingsRequest;
use App\Http\Resources\RaffleResource;
use App\Http\Resources\TransactionResource;
use App\Repositories\TransactionRepository;
use App\Services\RaffleService;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    public function __construct(
        private readonly RaffleService $raffleService,
        private readonly TransactionRepository $transactionRepository,
    ) {
    }

    public function index()
    {
        return RaffleResource::collection($this->raffleService->getAssignedRafflesWithAvailability(auth()->user()->getOwnerId()));
    }

    /**
     * TODO: Debe eliminarse cuando se implemente la vista de recibos
     */
    public function show(Request $request, $raffle)
    {
        $array = $request->all();

        return TransactionResource::collection($this->transactionRepository->getRaffleTransactionsPerDay($raffle, $array))
            ->additional([
                'total' => 'C$ ' . number_format($this->transactionRepository->getRaffleTransactionsTotalPerDay($raffle, $array)),
            ]);
    }

    public function update(UpdateSettingsRequest $request, $raffle)
    {
        $this->raffleService->updateUserSettings($raffle, $request->settings);

        return self::index();
    }
}
