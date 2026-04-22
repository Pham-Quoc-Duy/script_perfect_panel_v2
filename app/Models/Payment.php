<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Payment extends Model
{
    protected $table = 'payments';
    
    protected $fillable = [
        'user_id',
        'payment_method_id',
        'transaction_id',
        'amount',
        'bonus_amount',
        'total_amount',
        'currency',
        'exchange_rate',
        'status',
        'note',
        'payment_info',
        'domain'
    ];
    
    protected $casts = [
        'amount' => 'decimal:2',
        'bonus_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'exchange_rate' => 'decimal:4',
        'payment_info' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function user(): BelongsTo 
    { 
        return $this->belongsTo(User::class); 
    }

    public function paymentMethod(): BelongsTo 
    { 
        return $this->belongsTo(PaymentMethod::class); 
    }

    // Scopes
    public function scopeActive(Builder $query): Builder 
    { 
        return $query->where('status', 'completed'); 
    }

    public function scopeCompleted(Builder $query): Builder 
    { 
        return $query->where('status', 'completed'); 
    }

    public function scopePending(Builder $query): Builder 
    { 
        return $query->where('status', 'pending'); 
    }

    public function scopeByStatus(Builder $query, $status): Builder 
    { 
        return $query->where('status', $status); 
    }

    public function scopeByPaymentMethod(Builder $query, $methodId): Builder
    {
        return $query->where('payment_method_id', $methodId);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        if (empty(trim($search))) {
            return $query;
        }

        return $query->where(function($q) use ($search) {
            $q->where('transaction_id', 'like', "%{$search}%")
              ->orWhere('note', 'like', "%{$search}%");
        });
    }
}
