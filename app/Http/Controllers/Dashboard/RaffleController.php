<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\RaffleRequest;
use App\Models\Raffle;

class RaffleController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/Raffle/Index', [
            'raffles' => Raffle::all(),
        ]);
    }

    public function store(RaffleRequest $request)
    {
        Raffle::create($request->validated());

        return back();
    }

    public function update(RaffleRequest $request, Raffle $raffle)
    {
        $raffle->update($request->validated());

        return back();
    }

    public function destroy(Raffle $raffle)
    {
        $raffle->delete();

        return back();
    }
}
