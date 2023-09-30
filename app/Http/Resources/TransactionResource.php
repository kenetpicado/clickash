<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "digit" => $this->digit,
            "amount" => $this->amount,
            "client" => $this->client,
            "hour" => $this->hour,
            "created_at" => $this->created_at->format('d/m/y g:i A'),
            "raffle" => $this->raffle_name,
        ];
    }
}
