<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Currency extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'currency';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'code',
        'symbol',
        'exchange_rate',
        'name',
        'sync',
        'status',
        'symbol_position',
        'domain',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'exchange_rate' => 'decimal:8',
        'sync' => 'boolean',
        'status' => 'integer',
        'symbol_position' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [];

    /**
     * Scope a query to only include active currencies.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 1);
    }

    /**
     * Scope a query to only include inactive currencies.
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('status', 0);
    }

    /**
     * Scope a query to filter by domain.
     */
    public function scopeForDomain(Builder $query, ?string $domain): Builder
    {
        return $query->where('domain', $domain);
    }

    /**
     * Scope a query to only include currencies with auto sync enabled.
     */
    public function scopeSyncEnabled(Builder $query): Builder
    {
        return $query->where('sync', true);
    }

    /**
     * Get the formatted currency symbol with amount.
     */
    public function formatAmount(float $amount): string
    {
        $formattedAmount = number_format($amount, 2);
        
        return $this->symbol_position === 'before' 
            ? $this->symbol . $formattedAmount 
            : $formattedAmount . $this->symbol;
    }

    /**
     * Convert amount from base currency to this currency.
     */
    public function convertFromBase(float $baseAmount): float
    {
        return $baseAmount * $this->exchange_rate;
    }

    /**
     * Convert amount from this currency to base currency.
     */
    public function convertToBase(float $amount): float
    {
        return $this->exchange_rate > 0 ? $amount / $this->exchange_rate : 0;
    }

    /**
     * Check if currency is the base currency (exchange rate = 1).
     */
    public function isBaseCurrency(): bool
    {
        return (float) $this->exchange_rate === 1.0;
    }

    /**
     * Get currency display name with symbol.
     */
    public function getDisplayNameAttribute(): string
    {
        return "{$this->name} ({$this->symbol})";
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Ensure exchange rate is never zero
        static::saving(function ($currency) {
            if ($currency->exchange_rate <= 0) {
                $currency->exchange_rate = 1.00000000;
            }
        });
    }

    /**
     * Get the status label for display.
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status === 1 ? 'Hoạt động' : 'Tạm dừng';
    }

    /**
     * Get the sync label for display.
     */
    public function getSyncLabelAttribute(): string
    {
        return $this->sync ? 'Tự động' : 'Thủ công';
    }

    /**
     * Check if currency is active.
     */
    public function isActive(): bool
    {
        return $this->status === 1;
    }

    /**
     * Check if currency has auto sync enabled.
     */
    public function hasAutoSync(): bool
    {
        return (bool) $this->sync;
    }
}