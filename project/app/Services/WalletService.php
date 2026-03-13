<?php

namespace App\Services;

use App\DTO\Transaction\StoreDTO;
use App\Enums\Transaction\StatusEnum;
use App\Enums\Transaction\TypeEnum;
use App\Filters\Transaction\HashFilter;
use App\Filters\Transaction\TransactionFilter;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

readonly class WalletService
{
    public function __construct(
        private  UserRepository $userRepository,
        private TransactionRepository $transactionRepository
    ) {}

    public function deposit(float $amount, string $hash): array
    {
        $user = $this->userRepository->getAuthUser();
        return DB::transaction(function () use ($user, $amount, $hash) {
            if ($this->transactionRepository->getTransactionByFilter(new TransactionFilter(hash: new HashFilter($hash)))) {
                throw new \Exception('Транзакция уже в процессе выполнения!', 400);
            }
            $this->userRepository->incrementBalance($user, $amount);
            return $this->transactionRepository->store(new StoreDTO(
                userId: $user->id,
                amount: $amount,
                type: TypeEnum::DEPOSIT->value,
                status: StatusEnum::CONFIRMED->value,
                hash: $hash
            ))->toArray();
        });
    }

    public function withdraw(float $amount): array
    {
        $user = $this->userRepository->getAuthUser();
        return DB::transaction(function () use ($user, $amount) {
            $user = $this->userRepository->lockById($user->id);
            if ($user->balance < $amount) {
                throw new \Exception('Недостаточно средств на балансе', 400);
            }
            $this->userRepository->decrementBalance($user, $amount);
            return $this->transactionRepository->store(new StoreDTO(
                userId: $user->id,
                amount: $amount,
                type: TypeEnum::WITHDRAW->value,
                status: StatusEnum::PENDING->value,
            ))->toArray();
        });
    }
}
