<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'hour' => Carbon::parse($this->hour)->format('g:i A'),
            'status' => $this->status,
            'prize' => 'C$ ' . number_format($this->prize),
            'super_x' => $this->super_x,
            'created_at' => $this->created_at->format('d/m/y g:i A'),
            'raffle' => RaffleNameResource::make($this->whenLoaded('raffle')),
            'user' => UserNameResource::make($this->whenLoaded('user')),
        ];
    }
}
