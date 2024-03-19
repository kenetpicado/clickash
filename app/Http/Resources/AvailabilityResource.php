<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvailabilityResource extends JsonResource
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
            'order' => $this->order,
            'day' => $this->day,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'time_label' => Carbon::parse($this->start_time)->format('g:i A').' - '.Carbon::parse($this->end_time)->format('g:i A'),
            'blocked_hours' => $this->blocked_hours,
            'blocked_hours_parsed' => collect($this->blocked_hours)->map(function ($hour) {
                return Carbon::parse($hour)->format('g:i A');
            }),
        ];
    }
}
