<?php

namespace App\Repositories;

use App\DTO\Transaction\StoreDTO;
use App\Filters\Transaction\TransactionFilter;
use App\Models\Transaction;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TransactionRepository
{
    public function getTransactionByFilter(TransactionFilter $filter): Transaction|Collection|LengthAwarePaginator|null
    {
        $query = $filter->getQuery();
        return $filter->getReturnValue($query);
    }

    public function store(StoreDTO $dto): Transaction
    {
        return Transaction::create([
            'user_id' => $dto->userId,
            'amount' => $dto->amount,
            'type' => $dto->type,
            'status' => $dto->status,
            'hash' => $dto->hash,
        ]);
    }
}
