<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Repositories\RaffleUserRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;

class ClientareaController extends Controller
{
    public function __construct(
        private readonly RaffleUserRepository $raffleUserRepository,
        private readonly UserRepository $userRepository,
        private readonly TransactionRepository $transactionRepository
    ) {
    }

    public function __invoke()
    {
        return inertia('Clientarea/Index', [
            'raffles' => $this->raffleUserRepository->getRaffles(),
            'sellers' => $this->userRepository->getSellers(),
            'transactions' => $this->transactionRepository->getByTeam(),
            'daily_transactions' => $this->transactionRepository->getDailyTotalByTeam(),
        ]);
    }
}
