<?php

namespace App\Services;

use App\Repositories\RaffleUserRepository;
use Carbon\Carbon;

class RaffleUserService
{
    public function getRafflesWithResultFormated(array $request)
    {
        $results = (new RaffleUserRepository)->getRafflesWithResults($request);

        return $results->transform(function ($raffle) {
            return [
                'id' => $raffle->raffle_id,
                'name' => $raffle->raffle->name,
                'results' => $raffle->winningNumbers->map(fn ($item) => Carbon::parse($item->hour)->format('g:i A: ') . $item->number),
            ];
        });
    }
}
