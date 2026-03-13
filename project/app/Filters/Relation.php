<?php

namespace App\Filters;

readonly class Relation
{
    public function __construct(
        private array $relation,
    ) {}

    public function getRelation(): array
    {
        return $this->relation;
    }
}
