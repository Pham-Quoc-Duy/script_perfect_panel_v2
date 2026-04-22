<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'amount',
        'type',
        'status',
        'payment_method',
        'transaction_id',
        'description',
        'balance_after',
        'domain',
    ];

    protected $casts = [
        'amount'       => 'decimal:9',
        'balance_after'=> 'decimal:9',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
