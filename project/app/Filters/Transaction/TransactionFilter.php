<?php

namespace App\Filters\Transaction;

use App\Filters\IdFilter;
use App\Models\Transaction;
use App\Filters\Pagination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Exception;

class TransactionFilter
{
    private ?string $returnValue = null;

    public function __construct(
        private readonly ?IdFilter $id = null,
        private readonly ?HashFilter $hash = null,
        private ?Pagination $pagination = null
    ) {
        if (is_null($pagination)) {
            $this->pagination = new Pagination();
        }
    }

    public function getQuery(): Builder
    {
        $query = Transaction::query()
            ->when($this->id, function ($query) {
                $this->returnValue = $this->id->getReturnValue();
                if (is_int($this->id->getValue())) {
                    $query->where('id', $this->id->getValue());
                } else {
                    $query->whereIn('id', $this->id->getValue());
                }
                return $query;
            })
            ->when($this->hash, function ($query) {
                $this->returnValue = $this->hash->getReturnValue();
                return $query->where('hash', $this->hash->getValue());
            });
        $this->returnValue = $this->returnValue ?? 'collection';
        return $query;
    }

    public function getReturnValue(Builder $query): Transaction|Collection|LengthAwarePaginator|null
    {
        if (is_null($this->returnValue)) {
            throw new Exception('Необходимо сначала составить запрос, чтобы получить значения');
        }
        if ($this->returnValue === 'model') {
            $result = $query->first();
        } elseif ($this->returnValue === 'collection') {
            if ($this->pagination->getIsPagination()) {
                $result = $query->paginate($this->pagination->getCount());
            } else {
                $result = $query->get();
            }
        } else {
            throw new Exception('Не верно определен тип возвращаемого значения');
        }
        return $result;
    }
}
