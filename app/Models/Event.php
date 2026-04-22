<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'status',
        'max_spins_per_day',
        'max_spins_total',
        'rewards',
        'start_date',
        'end_date',
        'domain'
    ];

    protected $casts = [
        'rewards' => 'array',
        'status' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function spins(): HasMany
    {
        return $this->hasMany(EventSpin::class);
    }

    public function isActive(): bool
    {
        $now = now();
        return $this->status 
            && $this->start_date <= $now 
            && $this->end_date >= $now;
    }

    public function getUserSpinsToday($userId): int
    {
        return $this->spins()
            ->where('user_id', $userId)
            ->whereDate('created_at', today())
            ->count();
    }

    public function getUserTotalSpins($userId): int
    {
        return $this->spins()->where('user_id', $userId)->count();
    }

    public function canUserSpin($userId): bool
    {
        if (!$this->isActive()) {
            return false;
        }

        // Check daily limit
        if ($this->getUserSpinsToday($userId) >= $this->max_spins_per_day) {
            return false;
        }

        // Check total limit (0 = unlimited)
        if ($this->max_spins_total > 0 && $this->getUserTotalSpins($userId) >= $this->max_spins_total) {
            return false;
        }

        return true;
    }

    public function getRemainingSpinsToday($userId): int
    {
        return max(0, $this->max_spins_per_day - $this->getUserSpinsToday($userId));
    }
}
