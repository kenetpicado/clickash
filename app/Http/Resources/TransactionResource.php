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
            'id' => $this->id,
            'digit' => $this->digit,
            'amount' => $this->amount,
            'client' => $this->client,
            'hour' => $this->hour,
            'status' => $this->status,
            'prize' => $this->prize,
            'super_x' => $this->super_x,
            'created_at' => $this->created_at->format('d/m/y g:i A'),
            'raffle' => RaffleNameResource::make($this->whenLoaded('raffle')),
            'user' => UserNameResource::make($this->whenLoaded('user')),
        ];
    }
}
