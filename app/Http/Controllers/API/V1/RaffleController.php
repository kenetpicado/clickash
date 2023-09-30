<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RaffleRequest;
use App\Http\Resources\RaffleResource;
use App\Models\RaffleUser;
use App\Services\RaffleService;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    public function index()
    {
        return RaffleResource::collection((new RaffleService)->getRaffles());
    }

    public function show($raffle)
    {
        //mostrar las ventas de una rifa
        return response()->json([]);
    }

    public function update(RaffleRequest $request, $raffle)
    {
        RaffleUser::where('raffle_id', $raffle)
            ->where('user_id', auth()->id())
            ->update([
                'settings' => $request->settings
            ]);

        return self::index();
    }
}
