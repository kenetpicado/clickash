<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Services\RaffleService;
use Illuminate\Http\Request;

class ClientareaController extends Controller
{
    public function __invoke()
    {
        return inertia('Clientarea/Index', [
            'raffles' => (new RaffleService)->getRaffles()
        ]);
    }
}
