<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventSpin extends Model
{
    const UPDATED_AT = null;
    
    protected $fillable = [
        'event_id',
        'user_id',
        'reward_name',
        'reward_amount',
        'ip_address',
        'created_at'
    ];

    protected $casts = [
        'reward_amount' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
