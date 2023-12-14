<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Services\RaffleUserService;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct(
        private readonly RaffleUserService $raffleUserService,
    ) {
    }

    public function index(Request $request)
    {
        return inertia('Clientarea/Result/Index', [
            'results' => $this->raffleUserService->getRafflesWithResultFormated($request->all()),
        ]);
    }

    public function show($raffle)
    {
        //todo
    }
}
