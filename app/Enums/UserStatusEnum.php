<?php

namespace App\Enums;

enum UserStatusEnum: string
{
    case ENABLED = 'enabled';
    case DISABLED = 'disabled';
}