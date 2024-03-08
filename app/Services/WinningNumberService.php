<?php

namespace App\Services;

use App\Repositories\RaffleUserRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\WinningNumberRepository;
use Carbon\Carbon;

class WinningNumberService
{
    private WinningNumberRepository $winningNumberRepository;
    private TransactionRepository $transactionRepository;

    public function __construct()
    {
        $this->winningNumberRepository = new WinningNumberRepository();
        $this->transactionRepository = new TransactionRepository();
    }

    public function getWinningNumbers($raffle_id, $request = [])
    {
        return $this->winningNumberRepository->getWinningNumbers($raffle_id, $request);
    }

    public function store(array $request, $raffle_id): void
    {
        if (Carbon::parse($request['hour'])->isFuture()) {
            throw new \Exception('No puedes registrar una turno que no ha pasado', 403);
        }

        if ($this->winningNumberRepository->alreadyExists($raffle_id, $request['hour'])) {
            throw new \Exception('Ya existe registro para esta hora', 403);
        }

        $settings = (new RaffleUserRepository)->getSettings(auth()->id(), $raffle_id);

        if ($settings['date']) {
            if (!preg_match('/^\d{1,2}\/\d{1,2}$/', $request['number'])) {
                throw new \Exception('El número no tiene el formato correcto', 403);
            }

            $elements = explode('/', $request['number']);

            if ($elements[0] <= 0 || $elements[0] > 31) {
                throw new \Exception('El dia debe ser un número entre 1 y 31', 403);
            }

            if ($elements[1] <= 0 || $elements[1] > 12) {
                throw new \Exception('El mes debe ser un número entre 1 y 12', 403);
            }

            $elements = array_map(function ($element) {
                return str_pad($element, 2, '0', STR_PAD_LEFT);
            }, $elements);

            $request['number'] = implode('/', $elements);
        } else {
            if ($request['number'] > $settings['max'] || $request['number'] < $settings['min']) {
                throw new \Exception('El número debe estar entre ' . $settings['min'] . ' y ' . $settings['max'], 403);
            }

            $request['number'] = str_pad($request['number'], strlen($settings['max']), '0', STR_PAD_LEFT);
        }

        $winningNumber = $this->winningNumberRepository->store($request, $raffle_id);

        $this->transactionRepository->setWinningTransactions($winningNumber);
    }

    public function destroy($winningNumber): void
    {
        if ($winningNumber->created_at->diffInMinutes(Carbon::now()) > 30) {
            throw new \Exception('No puedes eliminar despues de 30 minutos', 403);
        }

        $this->transactionRepository->revertWinningTransactions($winningNumber);

        $winningNumber->delete();
    }
}
