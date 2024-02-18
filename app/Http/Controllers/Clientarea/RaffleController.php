<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UpdateSettingsRequest;
use App\Http\Resources\RaffleResource;
use App\Models\Raffle;
use App\Services\RaffleService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly RaffleService $raffleService,
    ) {
    }

    public function index()
    {
        return inertia('Clientarea/Raffle/Index', [
            'raffles' => RaffleResource::collection($this->raffleService->getAssignedRaffles()),
        ]);
    }

    public function show(Request $request, Raffle $raffle)
    {
        $array = $request->all();
        $array['raffle_id'] = $raffle->id;

        $data = $this->transactionService->getInvoices($array);

        return inertia('Clientarea/Raffle/Show', [
            'raffle' => $raffle,
            'invoices' => $data['invoices'],
            'total' => $data['total'],
        ]);
    }

    public function update(UpdateSettingsRequest $request, $raffle)
    {
        $this->raffleService->updateUserSettings($raffle, $request->settings);

        return back();
    }
}
