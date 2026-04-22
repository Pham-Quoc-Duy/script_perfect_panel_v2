<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'username', 'email', 'phone', 'password', 'balance','spent', 'api_key', 'is_active', 'timezone', 'lang','currency', 'level', 'role', 'transfer_code', 'referral_code', 'two_factor_enabled', 'two_factor_secret', 'two_factor_recovery_codes', 'domain'];
    protected $hidden = ['password', 'remember_token', 'two_factor_secret', 'two_factor_recovery_codes'];
    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed', 'balance' => 'decimal:8','spent' => 'decimal:8', 'is_active' => 'boolean', 'two_factor_enabled' => 'boolean', 'two_factor_confirmed_at' => 'datetime', 'two_factor_recovery_codes' => 'json'];

    public function getRouteKeyName()
    {
        return 'username';
    }

    // Relationships
    public function orders() { return $this->hasMany(Order::class); }
    public function transactions() { return $this->hasMany(Transaction::class); }
    public function tickets() { return $this->hasMany(Ticket::class); }
    public function referrals() { return $this->hasMany(Affiliate::class, 'referrer_id'); }
    public function referredBy() { return $this->hasOne(Affiliate::class, 'referred_id'); }

    // Helpers
    public function isRetail() { return $this->level === 'retail'; }
    public function isAgent() { return $this->level === 'agent'; }
    public function isDistributor() { return $this->level === 'distributor'; }
    public function isUser() { return $this->role === 'member'; }
    public function isAdmin() { return $this->role === 'admin'; }
    public function hasTwoFactorEnabled() { return $this->two_factor_enabled && !is_null($this->two_factor_secret); }

    // Scopes
    public function scopeByLevel($query, $level) { return $query->where('level', $level); }
    public function scopeByRole($query, $role) { return $query->where('role', $role); }
}
