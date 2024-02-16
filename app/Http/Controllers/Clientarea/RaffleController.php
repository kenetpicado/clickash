<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RaffleRequest;
use App\Models\Raffle;
use App\Repositories\RaffleUserRepository;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly RaffleUserRepository $raffleUserRepository,
    ) {
    }

    public function index(Request $request)
    {
        return inertia('Clientarea/Raffle/Index', [
            'raffles' => $this->raffleUserRepository->getRaffles(),
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

    public function update(RaffleRequest $request, $raffle)
    {
        $this->raffleUserRepository->updateSettings($raffle, $request->validated()['settings']);

        return back();
    }
}
