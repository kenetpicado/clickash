<?php

namespace App\Http\Controllers\API\V1;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\RaffleResource;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    public function __invoke()
    {
        if (auth()->user()->role == RoleEnum::OWNER->value)
            return RaffleResource::collection(auth()->user()->raffles);

        return RaffleResource::collection(auth()->user()->parentRaffles);
    }
}
