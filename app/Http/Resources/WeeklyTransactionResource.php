<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeeklyTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $balance = $this->income - $this->expenditure + $this->deposit - $this->withdrawal;
        return [
            'week' => $this->week,
            'week_label' => $this->week_label,
            'income' => 'C$' . number_format($this->income),
            'expenditure' => 'C$' . number_format($this->expenditure),
            'deposit' => 'C$' . number_format($this->deposit),
            'withdrawal' => 'C$' . number_format($this->withdrawal),
            'type' => $balance < 0 ? 'Pérdida' : 'Ganancia',
            'balance' => 'C$' . number_format($balance),
        ];
    }
}
