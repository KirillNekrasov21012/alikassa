<?php

namespace App\Enums\Transaction;

enum StatusEnum: string
{
    case PENDING  = 'pending';
    case CONFIRMED = 'confirmed';
    case FAILED = 'failed';
}
