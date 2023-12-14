<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\RaffleUserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct(
        private readonly RaffleUserService $raffleUserService,
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

    public function show($raffle)
    {
        //todo
    }
}
