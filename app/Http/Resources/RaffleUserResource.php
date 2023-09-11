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
            'name' => $this->raffle_name,
            'image' => $this->raffle_image,
            'settings' => $this->settings,
            'availability' => new AvailabilityResource($this->availability->first()),
        ];
    }
}
