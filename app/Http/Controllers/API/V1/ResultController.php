<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Repositories\TransactionRepository;
use App\Services\RaffleUserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct(
        private readonly RaffleUserService $raffleUserService,
        private readonly TransactionRepository $transactionRepository,
    ) {
    }

    public function index(Request $request)
    {
        $results = $this->raffleUserService->getRafflesWithResultFormated($request->all());

        $message = $request->has('date')
            ? 'Resultados del ' . Carbon::parse($request->get('date'))->format('d/m/Y')
            : 'Resultados del hoy';

        return response()->json([
            'message' => $message,
            'data' => $results,
        ]);
    }

    public function show(Request $request, $raffle)
    {
        $message = $request->has('date')
            ? 'Ganadores del ' . Carbon::parse($request->get('date'))->format('d/m/Y')
            : 'Ganadores de hoy';

        if (auth()->user()->isSeller())
            $data = $this->transactionRepository->getUserWinners(auth()->id(), $raffle, $request->all());
        else
            $data = $this->transactionRepository->getTeamWinners($raffle, $request->all());

        return TransactionResource::collection($data)
            ->additional([
                'message' => $message,
            ]);
    }
}
