<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\InvoiceTransactionResource;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InvoiceController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService
    ) {
    }

    public function index(Request $request)
    {
        $data = $this->transactionService->getInvoices($request->all(), $request->get('user_id'));

        return InvoiceResource::collection($data['invoices'])->additional(['total' => $data['total']]);
    }

    public function show($invoice)
    {
        $data = $this->transactionService->getInvoiceTransactions($invoice);

        return InvoiceTransactionResource::collection($data['transactions'])->additional(Arr::except($data, 'transactions'));
    }

    public function destroy($invoice)
    {
        $this->transactionService->destroyInvoice($invoice);

        return self::index(request());
    }
}
