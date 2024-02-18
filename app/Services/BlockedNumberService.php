<?php

namespace App\Services;

use App\Repositories\BlockedNumberRepository;

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

        if ($this->blockedNumberRepository->alreadyExists($request)) {
            throw new \Exception('El número ya está bloqueado');
        }

        if (!$request['settings']['general_limit'] && !$request['settings']['individual_limit']) {
            throw new \Exception('Debes seleccionar al menos un límite');
        }

        $this->blockedNumberRepository->store($request);
    }
}
