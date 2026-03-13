<?php

namespace App\DTO\Transaction;

class StoreDTO
{
    public function __construct(
        public int $userId,
        public float $amount,
        public string $type,
        public string $status,
        public ?string $hash = null,
    ) {}
}
