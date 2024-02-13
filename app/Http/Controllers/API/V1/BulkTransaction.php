<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\BulkTransactionRequest;
use App\Repositories\TransactionRepository;
use App\Services\TransactionService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BulkTransaction extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly TransactionRepository $transactionRepository,
    ) {
    }

    public function __invoke(BulkTransactionRequest $request)
    {
        $validated = $request->validated();

        $settings = $this->transactionService->validateBulkTransactions($validated);

        $storedTransactions = [];

        do {
            $invoiceNumber = $this->transactionService->generateInvoiceNumber();
        } while ($this->transactionService->existsInvoiceNumber($invoiceNumber));

        $transformedData = [];

        foreach ($validated['data'] as $transaction) {
            $key = $transaction['digit'] . $transaction['hour'] . $transaction['super_x'];

            if (!isset($transformedData[$key])) {
                $transformedData[$key] = $transaction;
                continue;
            }

            $transformedData[$key]['amount'] += $transaction['amount'];
        }

        $validated['data'] = array_values($transformedData);

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
                'invoice_number' => $invoiceNumber,
            ]);
        }

        $data = collect($storedTransactions)->map(function ($transaction) {
            return [
                'transaction_id' => $transaction['id'],
                'digit' => $transaction['digit'],
                'amount' => $transaction['super_x'] ? $transaction['amount'] / 2 : $transaction['amount'],
                'total' => $transaction['amount'],
                'hour' => Carbon::parse($transaction['hour'])->format('g:i A'),
                'prize' => $transaction['prize'],
                'status' => $transaction['status'],
                'super_x' => $transaction['super_x'],
            ];
        })
            ->sortBy('digit')
            ->sortBy('hour')
            ->values();

        return response()->json([
            'company' => auth()->user()->getCompanyName(),
            'datetime' => Carbon::now()->format('d/m/y g:i A'),
            'raffle' => DB::table('raffles')->where('id', $validated['raffle_id'])->value('name'),
            'seller' => auth()->user()->name,
            'client' => $storedTransactions[0]['client'],
            'total' => $data->sum('total'),
            'multiplier' => $settings['multiplier'] ?? 70,
            'invoice_number' => $invoiceNumber,
            'data' => $data,
        ]);
    }
}
