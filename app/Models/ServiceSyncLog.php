<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSyncLog extends Model
{
    protected $fillable = [
        'service_id', 'provider_id', 'provider_name', 'service_api',
        'change_type', 'old_value', 'new_value', 'field_changed',
        'is_read', 'domain',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'old_value' => 'float',
        'new_value' => 'float',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function provider()
    {
        return $this->belongsTo(ApiProvider::class, 'provider_id');
    }

    /**
     * Scope: chỉ lấy log của domain hiện tại
     */
    public function scopeForDomain($query)
    {
        return $query->where('domain', getDomain());
    }

    /**
     * Scope: chưa đọc
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Đánh dấu tất cả đã đọc
     */
    public static function markAllRead(string $domain): int
    {
        return static::where('domain', $domain)
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }
}
