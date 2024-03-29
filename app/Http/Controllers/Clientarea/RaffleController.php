<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UpdateSettingsRequest;
use App\Http\Resources\InvoiceResource;
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
            'raffles' => RaffleResource::collection($this->raffleService->getAssignedRaffles())->resolve(),
        ]);
    }

    public function show(Request $request, Raffle $raffle)
    {
        $array = $request->merge(['raffle_id' => $raffle->id])->all();

        $data = $this->transactionService->getInvoices($array);

        return inertia('Clientarea/Raffle/Show', [
            'raffle' => $raffle,
            'invoices' => InvoiceResource::collection($data['invoices']),
            'total' => $data['total'],
        ]);
    }

    public function update(UpdateSettingsRequest $request, $raffle)
    {
        $this->raffleService->updateUserSettings($raffle, $request->settings);

        return back();
    }
}
