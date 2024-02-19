<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService
    ) {
    }

    public function index(Request $request)
    {
        $data = $this->transactionService->getInvoices($request->all());

        return inertia('Clientarea/Invoice/Index', [
            'invoices' => $data['invoices'],
            'total' => $data['total'],
        ]);
    }

    public function show($invoice)
    {
        $data = $this->transactionService->getInvoiceTransactions($invoice);

        return inertia('Clientarea/Invoice/Show', [
            'transactions' => TransactionResource::collection($data['transactions'])->resolve(),
            'total' =>  $data['total'],
            'invoice_number' => $invoice,
            'raffle' => $data['raffle'],
            'user' => $data['user'],
        ]);
    }
}
