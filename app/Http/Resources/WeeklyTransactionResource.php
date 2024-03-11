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
            'resume' => [
                'Ingresos: C$ ' . number_format($this->income),
                'Egresos: C$ ' . number_format($this->expenditure),
                'Depósitos: C$ ' . number_format($this->deposit),
                'Retiros: C$ ' . number_format($this->withdrawal),
                ($balance < 0 ? 'Pérdida' : 'Ganancia') . ': C$ ' . number_format(abs($balance)),
            ],
        ];
    }
}
