<?php

namespace App\Models;

use App\Enums\Transaction\StatusEnum;
use App\Enums\Transaction\TypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'transactions';
    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'status',
        'hash',
    ];
    protected $casts = [
        'type' => TypeEnum::class,
        'status' => StatusEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class. 'user_id', 'id');
    }
}
