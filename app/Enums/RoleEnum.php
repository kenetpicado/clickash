<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ROOT = 'root';
    case OWNER = 'owner';
    case SELLER = 'seller';
}
