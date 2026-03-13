<?php

namespace App\Filters;

class NameFilter extends BaseFilter
{
    private string $value;

    public function __construct(string $name)
    {
        $this->value = $name;
        $this->returnValue = 'model';
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
