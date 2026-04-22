<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildPanel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'domain',
        'domain_panel',
        'price',
        'total_orders',
        'total_services',
        'total_users',
        'access',
        'settings',
        'status',
        'last_sync_at',
        'expires_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'total_orders' => 'integer',
        'total_services' => 'integer',
        'total_users' => 'integer',
        'settings' => 'array',
        'last_sync_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    protected $attributes = [
        'price' => 0,
        'total_orders' => 0,
        'total_services' => 0,
        'total_users' => 0,
        'access' => 'child',
        'status' => 'pending',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'child_panel_id');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeSuspended($query)
    {
        return $query->where('status', 'suspended');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<', now());
    }

    public function scopeNotExpired($query)
    {
        return $query->where(function($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>=', now());
        });
    }

    // Accessors
    public function getFullUrlAttribute()
    {
        return 'https://' . $this->domain_panel;
    }

    public function getIsExpiredAttribute()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function getIsActiveAttribute()
    {
        return $this->status === 'completed' && !$this->is_expired;
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Chờ xử lý',
            'completed' => 'Hoàn thành',
            'suspended' => 'Ngưng hoạt động',
            default => $this->status,
        };
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'completed' => 'success',
            'suspended' => 'danger',
            default => 'secondary',
        };
    }

    // Methods
    public function updateStats($orders = null, $services = null, $users = null)
    {
        $data = [];
        if ($orders !== null) $data['total_orders'] = $orders;
        if ($services !== null) $data['total_services'] = $services;
        if ($users !== null) $data['total_users'] = $users;
        
        if (!empty($data)) {
            $this->update($data);
        }
        
        return $this;
    }

    public function syncLastSync()
    {
        $this->update(['last_sync_at' => now()]);
        return $this;
    }

    public function activate()
    {
        $this->update(['status' => 'completed']);
        return $this;
    }

    public function suspend()
    {
        $this->update(['status' => 'suspended']);
        return $this;
    }

    public function deactivate()
    {
        $this->update(['status' => 'suspended']);
        return $this;
    }

    public function extend($days)
    {
        $expiresAt = $this->expires_at ?? now();
        $this->update(['expires_at' => $expiresAt->addDays($days)]);
        return $this;
    }

    // Settings methods
    public function setSetting($key, $value)
    {
        $settings = $this->settings ?? [];
        $settings[$key] = $value;
        $this->update(['settings' => $settings]);
        return $this;
    }

    public function getSetting($key, $default = null)
    {
        $settings = $this->settings ?? [];
        return $settings[$key] ?? $default;
    }

    public function hasSetting($key)
    {
        $settings = $this->settings ?? [];
        return isset($settings[$key]);
    }

    public function removeSetting($key)
    {
        $settings = $this->settings ?? [];
        unset($settings[$key]);
        $this->update(['settings' => $settings]);
        return $this;
    }

    public function getSettings()
    {
        return $this->settings ?? [];
    }
}
