<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Raffle;
use Illuminate\Http\Request;

class RaffleCloneController extends Controller
{
    public function __invoke(Request $request, Raffle $raffle)
    {
        $cloned = $raffle->replicate();
        $cloned->name = $request->name;
        $cloned->saveQuietly();

        $cloned->availability()->createMany(
            $raffle->availability()->whereNull('user_id')->get()->toArray()
        );

        return back();
    }
}
