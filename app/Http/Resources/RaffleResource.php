<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RaffleResource extends JsonResource
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
            'name' => $this->name,
            'image' => $this->image,
            'settings' => $this->pivot->settings,
            'blocked_hours' => collect($this->currentAvailability?->blocked_hours ?? [])->filter(fn ($value) => Carbon::now()->lt($value))->values(),
        ];
    }
}
