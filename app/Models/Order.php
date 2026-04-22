<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'service_id', 'link', 'comment', 'quantity', 'rate', 'charge', 'total', 'start_count', 'remains', 'orders_api', 'service_api', 'provider_id', 'provider_name', 'type', 'currency', 'refill', 'refill_status', 'cancel', 'cancel_status', 'dripfeed', 'loop_quantity', 'loop_spacing', 'schedule_time', 'start_time', 'success_time', 'note', 'reaction', 'status', 'order_data', 'response_data', 'ticket', 'domain'];
    protected $casts = ['rate' => 'decimal:4', 'refill' => 'boolean', 'cancel' => 'boolean', 'dripfeed' => 'boolean', 'schedule_time' => 'datetime', 'start_time' => 'datetime', 'success_time' => 'datetime', 'order_data' => 'json', 'response_data' => 'json'];

    // Relationships
    public function user() { return $this->belongsTo(User::class); }
    public function service() { return $this->belongsTo(Service::class); }
    public function platform() { return $this->hasOneThrough(Platform::class, Service::class, 'id', 'id', 'service_id', 'platform_id'); }
    public function apiProvider() { return $this->belongsTo(ApiProvider::class, 'provider_name', 'name'); }

    // Helpers
    public function isCompleted() { return $this->status === 'completed'; }
    public function isPending() { return $this->status === 'pending'; }
    public function canRefill() { return $this->refill && $this->isCompleted(); }
    public function canCancel() { return $this->cancel && $this->isPending(); }
    public function getProgressPercentage() { return $this->quantity > 0 ? round((($this->quantity - $this->remains) / $this->quantity) * 100, 2) : 0; }

    // Scopes
    public function scopeByStatus($query, $status) { return $query->where('status', $status); }
}
