<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Repositories\RaffleUserRepository;
use Illuminate\Http\Request;

class ClientareaController extends Controller
{
    public function __construct(
        private readonly RaffleUserRepository $raffleUserRepository,
    ) {
    }

    public function __invoke(Request $request)
    {
        return inertia('Clientarea/Index', [
            'raffles' => $this->raffleUserRepository->getRaffles(),
        ]);
    }
}
