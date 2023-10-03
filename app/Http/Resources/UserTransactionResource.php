<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'digit' => $this->digit,
            'amount' => $this->amount,
            'client' => $this->client,
            'hour' => $this->hour,
            'raffle' => $this->raffle->name,
        ];
    }
}
