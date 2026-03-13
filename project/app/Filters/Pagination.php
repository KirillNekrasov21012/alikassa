<?php

namespace App\Filters;

readonly class Pagination
{
    public function __construct(
        private ?bool $isPagination = false,
        private ?int $count = 10
    ) {}

    public function getIsPagination(): bool
    {
        return $this->isPagination ?? false;
    }

    public function getCount(): int
    {
        return $this->count ?? 10;
    }
}
