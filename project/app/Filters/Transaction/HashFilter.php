<?php

namespace App\Filters\Transaction;

use App\Filters\BaseFilter;

class HashFilter extends BaseFilter
{
    public function __construct(
        private readonly string $hash,
    ) {
        $this->returnValue = 'model';
    }

    public function getValue(): string
    {
        return $this->hash;
    }
}
