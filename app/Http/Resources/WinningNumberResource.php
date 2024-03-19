<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WinningNumberResource extends JsonResource
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
            'number' => $this->number,
            'hour' => Carbon::parse($this->hour)->format('g:i A'),
            'date' => Carbon::createFromFormat('Y-m-d', $this->date)->format('d/m/Y'),
        ];
    }
}
