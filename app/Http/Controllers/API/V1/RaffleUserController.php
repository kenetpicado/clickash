<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RaffleUserRequest;
use App\Http\Resources\RaffleUserResource;
use App\Models\RaffleUser;
use App\Services\RaffleUserService;
use Illuminate\Http\Request;

class RaffleUserController extends Controller
{
    public function index()
    {
        return RaffleUserResource::collection((new RaffleUserService)->getRafflesWithAvailability());
    }

    public function update(RaffleUserRequest $request, $raffle)
    {
        RaffleUser::where('id', $raffle)->update($request->validated());

        return self::index();
    }
}
