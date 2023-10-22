<?php

namespace App\Enums;

enum TransactionStatusEnum: string
{
    case SOLD = 'VENDIDO';
    case PRIZE = 'PREMIADO';
    case PAID = 'PAGADO';
}
