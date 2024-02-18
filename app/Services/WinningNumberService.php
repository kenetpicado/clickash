<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use App\Repositories\WinningNumberRepository;
use Carbon\Carbon;

class WinningNumberService
{
    private $winningNumberRepository;
    private $transactionRepository;

    public function __construct()
    {
        $this->winningNumberRepository = new WinningNumberRepository();
        $this->transactionRepository = new TransactionRepository();
    }

    public function getWinningNumbers($raffle_id, $request = [])
    {
        return $this->winningNumberRepository->getByRaffle($raffle_id, $request);
    }

    public function store(array $request, $raffle_id)
    {
        if (Carbon::parse($request['hour'])->isFuture()) {
            throw new \Exception('No puedes registrar una turno que no ha pasado', 403);
        }

        if ($this->winningNumberRepository->alreadyExists($raffle_id, $request['hour'])) {
            throw new \Exception('Ya existe registro para esta hora', 403);
        }

        $winningNumber = $this->winningNumberRepository->store($request, $raffle_id);

        $this->transactionRepository->setWinningTransactions($winningNumber);
    }

    public function destroy($winningNumber)
    {
        if ($winningNumber->created_at->diffInMinutes(Carbon::now()) > 30) {
            throw new \Exception('No puedes eliminar despues de 30 minutos', 403);
        }

        $this->transactionRepository->revertWinningTransactions($winningNumber);

        $winningNumber->delete();
    }
}
