<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\WinningNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $results = [];

        $date = $request->get('date', Carbon::now()->format('Y-m-d'));

        $message = $request->has('date')
            ? 'Resultados del '.Carbon::parse($request->get('date'))->format('d/m/Y')
            : 'Resultados del hoy';

        $numbers = WinningNumber::with('raffle:id,name')
            ->where('user_id', auth()->user()->getOwnerId())
            ->where('date', $date)
            ->orderBy('raffle_id')
            ->orderBy('hour')
            ->get();

        $results = $numbers->groupBy('raffle.name')->mapWithKeys(function ($numbers, $raffleName) {
            return [
                $raffleName => [
                    'id' => $numbers->first()->raffle_id,
                    'raffle' => $raffleName,
                    'results' => $numbers->map(function ($item) {
                        return Carbon::parse($item->hour)->format('g:i A: ').$item->number;
                    }),
                ],
            ];
        });

        return response()->json(
            [
                'data' => $results->values(),
                'message' => $message,
            ]
        );
    }

    public function show($raffle)
    {
        //todo
    }
}
