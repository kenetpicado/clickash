<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'created_at' => $this->created_at->format('d/m/y g:i A'),
            'invoice_number' => $this->invoice_number,
            'raffle' => $this->raffle,
            'user' => $this->user,
            'client' => $this->client,
            'status' => $this->deleted_at ? 'ELIMINADO: '.$this->deleted_at->format('g:s A') : 'VENDIDO',
            'total' => 'C$ '.number_format($this->total),
        ];
    }
}
