<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function getAuthUser(): ?User
    {
        $user = Auth::user();
        if (is_null($user)) {
            Artisan::call('db:seed --class=UserSeeder');
            $user = User::where('email', 'test@mail.com')->first();
        }
        return $user;
    }

    public function incrementBalance(User $user, int $amount): void
    {
        $user->increment('balance', $amount);
    }

    public function decrementBalance(User $user, float $amount): void
    {
        $user->decrement('balance', $amount);
    }

    public function lockById(int $id): User
    {
        return User::where('id', $id) ->lockForUpdate() ->firstOrFail();
    }
}
