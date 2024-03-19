<?php

namespace App\Services;

use App\Repositories\BlockedNumberRepository;
use App\Repositories\RaffleUserRepository;

class BlockedNumberService
{
    private BlockedNumberRepository $blockedNumberRepository;

    public function __construct()
    {
        $this->blockedNumberRepository = new BlockedNumberRepository();
    }

    public function getRaffleBlockedNumbers($raffle_id)
    {
        return $this->blockedNumberRepository->getRaffleBlockedNumbers($raffle_id);
    }

    public function getUserBlockedNumbers($user_id, $raffle_id = null)
    {
        return $this->blockedNumberRepository->getUserBlockedNumbers($user_id, $raffle_id);
    }

    public function store(array $request, $user_id = null)
    {
        $request['user_id'] = $user_id ?? auth()->id();

        $settings = (new RaffleUserRepository)->getSettings(auth()->id(), $request['raffle_id']);
        $request['number'] = (new WinningNumberService)->getParsedNumber($settings, $request['number']);

        if ($this->blockedNumberRepository->alreadyExists($request)) {
            throw new \Exception('El dígito ya está bloqueado', 403);
        }

        if (! $request['settings']['general_limit'] && ! $request['settings']['individual_limit']) {
            throw new \Exception('Debes seleccionar al menos un límite', 403);
        }

        $this->blockedNumberRepository->store($request);
    }
}
