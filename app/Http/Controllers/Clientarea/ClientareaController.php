<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Services\RaffleService;

class ClientareaController extends Controller
{
    public function __invoke()
    {
        return inertia('Clientarea/Index', [
            'raffles' => (new RaffleService)->getRaffles(),
        ]);
    }
}
