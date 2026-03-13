<?php

namespace App\Filters;

abstract class BaseFilter
{
    protected string $returnValue;
    public function getReturnValue(): string
    {
        return $this->returnValue;
    }
}
