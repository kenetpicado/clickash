<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\BulkTransactionRequest;
use App\Repositories\RaffleUserRepository;
use App\Repositories\TransactionRepository;
use App\Services\TransactionService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BulkTransaction extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly TransactionRepository $transactionRepository,
        private readonly RaffleUserRepository $raffleUserRepository,
    ) {
    }

    public function __invoke(BulkTransactionRequest $request)
    {
        $validated = $request->validated();

        $this->transactionService->validateBulkTransactions($validated);

        $settings = $this->raffleUserRepository->getSettings(auth()->user()->getOwnerId(), $validated['raffle_id']);

        $storedTransactions = [];

        foreach ($validated['data'] as $transaction) {

            $prize = $transaction['amount'] * ($settings['multiplier'] ?? 70);

            if ($transaction['super_x'] && $settings['super_x']) {
                $transaction['amount'] = $transaction['amount'] * 2;
                $prize = $prize * 2;
            } else {
                $transaction['super_x'] = false;
            }

            $storedTransactions[] = $this->transactionRepository->store($transaction + [
                'raffle_id' => $validated['raffle_id'],
                'prize' => $prize,
                'client' => $validated['client'],
            ]);
        }

        $data = array_map(function ($transaction) {
            return [
                'transaction_id' => $transaction['id'],
                'digit' => $transaction['digit'],
                'amount' => $transaction['super_x'] ? $transaction['amount'] / 2 : $transaction['amount'],
                'total' => $transaction['amount'],
                'hour' => $transaction['hour'],
                'prize' => $transaction['prize'],
                'status' => $transaction['status'],
                'super_x' => $transaction['super_x'],
            ];
        }, $storedTransactions);

        return response()->json([
            'company' => DB::table('users')->where('id', auth()->user()->getOwnerId())->value('company_name'),
            'datetime' => Carbon::now()->format('d M Y H:i:s'),
            'raffle' => DB::table('raffles')->where('id', $validated['raffle_id'])->value('name'),
            'seller' => auth()->user()->name,
            'client' => $storedTransactions[0]['client'],
            'total' => array_sum(array_column($data, 'total')),
            'multiplier' => $settings['multiplier'] ?? 70,
            'data' => $data,
        ]);
    }
}
