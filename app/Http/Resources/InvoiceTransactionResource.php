<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $realAmount = $this->super_x ?
            $this->amount / 2 :
            $this->amount;

        return [
            'digit' => $this->digit,
            'amount' => $realAmount,
            'total' => $this->amount,
            'prize' => $this->prize,
            'hour' => Carbon::parse($this->hour)->format('g:i A'),
        ];
    }
}
