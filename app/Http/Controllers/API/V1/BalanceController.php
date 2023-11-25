<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BalanceResource;
use App\Repositories\TransactionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function __invoke(Request $request)
    {
        $balance = null;
        $startOfWeek = Carbon::now()->startOfWeek()->format('d M Y');

        if (auth()->user()->role === 'seller') {
            $balance = (new TransactionRepository)->getBalanceByUser(auth()->id(), $request->all());
        } elseif ($request->has('user_id')) {
            $balance = (new TransactionRepository)->getBalanceByUser($request->get('user_id'), $request->all());
        } else {
            $balance = (new TransactionRepository)->getBalanceTeam($request->all());
        }

        return BalanceResource::make($balance)
            ->additional([
                'date' => isset($request['date']) ? Carbon::parse($request['date'])->format('d M Y') : "Desde {$startOfWeek}",
            ]);
    }
}
