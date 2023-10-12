<?php

namespace App\Traits;

trait AuthRoleTrait
{
    public function isOwner()
    {
        return auth()->user()->role === 'owner';
    }

    public function ownerId()
    {
        return $this->isOwner() ? auth()->id() : auth()->user()->owner_id;
    }
}
