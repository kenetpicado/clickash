<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BalanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'income' => 'C$ '.number_format($this->income),
            'expenditure' => 'C$ '.number_format($this->expenditure),
            'balance' => 'C$ '.number_format($this->income - $this->expenditure),
        ];
    }
}
