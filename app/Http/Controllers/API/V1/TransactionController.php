<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Raffle;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return TransactionResource::collection(
            Transaction::query()
                ->where('user_id', auth()->id())
                ->latest("id")
                ->addSelect([
                    'raffle_name' => Raffle::query()
                        ->select('name')
                        ->whereColumn('raffle_id', 'raffles.id')
                        ->limit(1),
                ])
                ->where('created_at', '>=', now()->format('Y-m-d') . ' 00:00:00')
                ->get()
        );
    }

    public function store(TransactionRequest $request)
    {
        Transaction::create($request->validated() + ["user_id" => auth()->id()]);

        return response()->noContent();
    }
}
