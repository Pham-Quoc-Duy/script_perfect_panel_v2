<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class PaymentMethod extends Model
{
    // Payment method types
    const TYPE_BANK_VN = 'bank_vn';
    const TYPE_BINANCE = 'binance';
    const TYPE_PAYEER = 'payeer';
    const TYPE_OTHER = 'other';

    protected $fillable = [
        'name', 
        'type',
        'image', 
        'position', 
        'status', 
        'domain'
    ];

    protected $casts = [
        'status' => 'boolean',
        'position' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = [
        'payments_count',
        'localized_name', 
        'image_url',
        'type_label',
        'parsed_config'
    ];

    // Relationships
    public function payments(): HasMany 
    { 
        return $this->hasMany(Payment::class); 
    }

    public function activePayments(): HasMany
    {
        return $this->hasMany(Payment::class)->where('status', true);
    }

    // Scopes
    public function scopeActive(Builder $query): Builder 
    { 
        return $query->where('status', true); 
    }

    public function scopeOrdered(Builder $query): Builder 
    { 
        return $query->orderBy('position', 'asc')
                    ->orderBy('name', 'asc'); 
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        if (empty(trim($search))) {
            return $query;
        }

        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%");
    }

    public function scopeByType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    // Accessors & Mutators
    public function getName(string $lang = null): ?string 
    { 
        return $this->name;
    }

    // Computed Attributes
    public function getPaymentsCountAttribute(): int
    {
        return Cache::remember(
            "payment_method_{$this->id}_payments_count", 
            now()->addMinutes(30), 
            fn() => $this->payments()->count()
        );
    }

    public function getLocalizedNameAttribute(): ?string
    {
        return $this->name;
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }
        
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }
        
        return asset('storage/payment-methods/' . $this->image);
    }

    // Helper Methods
    public function hasPayments(): bool
    {
        return $this->payments_count > 0;
    }

    public function canDelete(): bool
    {
        return !$this->hasPayments();
    }

    public function toggleStatus(): bool
    {
        $this->status = !$this->status;
        $this->clearCache();
        return $this->save();
    }

    public function clearCache(): void
    {
        Cache::forget("payment_method_{$this->id}_payments_count");
    }

    // Static Methods
    public static function getNextPosition(): int
    {
        return (static::max('position') ?? 0) + 1;
    }

    public static function getTypes(): array
    {
        return [
            self::TYPE_BANK_VN => 'Ngân hàng Việt Nam',
            self::TYPE_BINANCE => 'Binance',
            self::TYPE_PAYEER => 'Payeer',
            self::TYPE_OTHER => 'Khác',
        ];
    }

    public static function getTypeLabel(string $type): string
    {
        return self::getTypes()[$type] ?? 'Unknown';
    }

    public function getTypeLabelAttribute(): string
    {
        return self::getTypeLabel($this->type ?? self::TYPE_OTHER);
    }

    public function getParsedConfigAttribute(): array
    {
        if (!$this->config) {
            return [];
        }
        
        return is_string($this->config) 
            ? json_decode($this->config, true) ?? [] 
            : (array) $this->config;
    }

    public static function reorder(array $paymentMethodIds): bool
    {
        try {
            foreach ($paymentMethodIds as $position => $paymentMethodId) {
                static::where('id', $paymentMethodId)
                      ->update(['position' => $position + 1]);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    // Boot method
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($paymentMethod) {
            if (!$paymentMethod->position) {
                $paymentMethod->position = static::getNextPosition();
            }
        });

        static::saved(function ($paymentMethod) {
            $paymentMethod->clearCache();
        });

        static::deleted(function ($paymentMethod) {
            $paymentMethod->clearCache();
        });
    }
}