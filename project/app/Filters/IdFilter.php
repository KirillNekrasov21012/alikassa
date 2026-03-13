<?php

namespace App\Filters;

class IdFilter extends BaseFilter
{
    private int|array $value;

    public function __construct(int|array $id)
    {
        $this->value = $id;
        $this->returnValue = is_int($id) ? 'model' : 'collection';
    }

    public function getValue(): int|array
    {
        return $this->value;
    }
}
