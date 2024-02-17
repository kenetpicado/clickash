<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\InvoiceTransactionResource;
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
        $data = $this->transactionService->getInvoices($request->all(), $request->get('user_id'));

        return InvoiceResource::collection($data['invoices'])
            ->additional([
                'total' => $data['total'],
            ]);
    }

    public function show($invoice)
    {
        $data = $this->transactionService->getInvoiceTransactions($invoice);

        return InvoiceTransactionResource::collection($data['transactions'])
            ->additional([
                'company' => $data['company'],
                'seller' => $data['user'],
                'datetime' => $data['datetime'],
                'raffle' => $data['raffle'],
                'invoice_number' => $data['invoice_number'],
                'total' => $data['total'],
                'multiplier' => '',
            ]);
    }

    public function destroy($invoice)
    {
        $this->transactionService->destroyInvoice($invoice);

        return self::index(request());
    }
}
