<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArchingResource extends JsonResource
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
            'type' => $this->type,
            'amount' => "C$ " . number_format($this->amount),
            'current_balance' => "C$ " . $this->current_balance,
            'seller' => UserNameResource::make($this->whenLoaded('seller')),
        ];
    }
}
