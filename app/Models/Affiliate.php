<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    protected $fillable = ['referrer_id', 'referred_id', 'referral_code', 'commission_rate', 'total_earned', 'total_orders', 'orders_count', 'status', 'first_order_at', 'last_order_at', 'note', 'domain'];
    protected $casts = ['commission_rate' => 'decimal:2', 'total_earned' => 'decimal:4', 'total_orders' => 'decimal:4', 'first_order_at' => 'datetime', 'last_order_at' => 'datetime'];

    // Relationships
    public function referrer() { return $this->belongsTo(User::class, 'referrer_id'); }
    public function referred() { return $this->belongsTo(User::class, 'referred_id'); }

    // Helpers
    public function isActive() { return $this->status === 'active'; }
    public function addCommission($amount) { $this->increment('total_earned', $amount); $this->increment('total_orders', $amount); $this->increment('orders_count'); $this->update(['last_order_at' => now()]); }
    public function getCommissionAmount($orderAmount) { return $orderAmount * ($this->commission_rate / 100); }

    // Scopes
    public function scopeActive($query) { return $query->where('status', 'active'); }
    public function scopeByReferrer($query, $referrerId) { return $query->where('referrer_id', $referrerId); }
}