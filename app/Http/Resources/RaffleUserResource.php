<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RaffleUserResource extends JsonResource
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
            'name' => $this->raffle->name,
            'image' => $this->raffle->image,
            'settings' => $this->settings,
            'availability' => new AvailabilityResource($this->availability->first()),
        ];
    }
}
