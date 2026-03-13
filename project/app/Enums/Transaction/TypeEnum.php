<?php

namespace App\Enums\Transaction;

enum TypeEnum: string
{
    case DEPOSIT  = 'deposit';
    case WITHDRAW = 'withdraw';
    case FEE = 'fee';
}
