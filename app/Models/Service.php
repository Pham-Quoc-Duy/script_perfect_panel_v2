<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'category_id', 'name', 'title', 'description', 'image', 'position',
        'rate_retail', 'rate_agent', 'rate_distributor', 
        'rate_original', 'rate_retail_up', 'rate_agent_up', 'rate_distributor_up',
        'min', 'max', 'service_api', 'provider_id', 'provider_name',
        'type', 'type_service', 'type_radio', 'refill', 'cancel', 'dripfeed', 
        'sync_rate', 'sync_min_max', 'sync_action',
        'average_time', 'note', 'reaction', 'attributes',
        'status', 'domain'
    ];
    
    protected $casts = [
        'name' => 'json',
        'position' => 'integer',
        'rate_retail' => 'decimal:4', 
        'rate_agent' => 'decimal:4', 
        'rate_distributor' => 'decimal:4',
        'rate_original' => 'decimal:4',
        'rate_retail_up' => 'decimal:2',
        'rate_agent_up' => 'decimal:2',
        'rate_distributor_up' => 'decimal:2',
        'refill' => 'boolean', 
        'cancel' => 'boolean', 
        'dripfeed' => 'boolean', 
        'sync_rate' => 'boolean',
        'sync_min_max' => 'boolean',
        'sync_action' => 'boolean',
        'status' => 'boolean',
        'attributes' => 'array'
    ];

    // Relationships
    public function category() 
    { 
        return $this->belongsTo(Category::class); 
    }

    public function provider() 
    { 
        return $this->belongsTo(ApiProvider::class, 'provider_id'); 
    }

    public function orders() 
    { 
        return $this->hasMany(Order::class); 
    }

    // Get localized name
    public function getName(?string $lang = null): string
    {
        $lang = $lang ?? (auth()->check() ? auth()->user()->lang : 'en');
        $name = $this->name;
        return is_array($name) ? ($name[$lang] ?? $name['en'] ?? reset($name) ?? 'Unnamed') : ($name ?? 'Unnamed');
    }

    // Get localized title
    public function getTitle(?string $lang = null): string
    {
        $lang = $lang ?? (auth()->check() ? auth()->user()->lang : 'en');
        $title = $this->title;
        return is_array($title) ? ($title[$lang] ?? $title['en'] ?? reset($title) ?? '') : ($title ?? '');
    }

    // Get localized description
    public function getDescription(?string $lang = null): string
    {
        $lang = $lang ?? (auth()->check() ? auth()->user()->lang : 'en');
        $desc = $this->description;
        return is_array($desc) ? ($desc[$lang] ?? $desc['en'] ?? reset($desc) ?? '') : ($desc ?? '');
    }

    // Get any localized field
    public function getLocalized(string $field, ?string $lang = null, string $default = ''): string
    {
        $lang = $lang ?? (auth()->check() ? auth()->user()->lang : 'en');
        $data = $this->{$field};
        return is_array($data) ? ($data[$lang] ?? $data['en'] ?? reset($data) ?? $default) : ($data ?? $default);
    }

    // Accessors
    public function getRateAttribute()
    {
        return $this->rate_retail;
    }

    public function getRateFormattedAttribute()
    {
        return '$' . number_format($this->rate_retail, 4) . ' per 1000';
    }

    // Scopes
    public function scopeActive($query) 
    { 
        return $query->where('status', true); 
    }

    public function scopeOrdered($query) 
    { 
        return $query->orderBy('position', 'asc'); 
    }

    // Boot method
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($service) {
            if (!$service->position) {
                $service->position = static::where('category_id', $service->category_id)->max('position') + 1;
            }
            
            // Đảm bảo attributes luôn là array
            if (is_null($service->attributes)) {
                $service->attributes = [];
            }
        });
        
        static::updating(function ($service) {
            // Đảm bảo attributes luôn là array khi update
            if (is_null($service->attributes)) {
                $service->attributes = [];
            }
        });
        
        static::saved(function ($service) {
            // Lấy attributes trực tiếp từ database (raw value)
            $attributesRaw = $service->getAttributes()['attributes'] ?? '[]';
            $attributesArray = json_decode($attributesRaw, true) ?? [];
            
            // Log attributes sau khi save theo format yêu cầu
            \Log::info('Service saved with attributes', [
                'service_id' => $service->id,
                'attributes' => [
                    'array' => $attributesArray,
                    'isEmpty' => empty($attributesArray),
                    'type' => 'array',
                    'json' => $attributesRaw
                ]
            ]);
        });
    }
    
    /**
     * Mutator: Ensure attributes is always stored as JSON array
     */
    protected function setAttributesAttribute($value)
    {
        // Luôn convert thành JSON array format
        if (is_null($value)) {
            $this->attributes['attributes'] = json_encode([]);
            return;
        }
        
        if (is_string($value)) {
            // Nếu là string, cố gắng parse
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                $this->attributes['attributes'] = json_encode($decoded);
                return;
            }
            // Nếu không phải JSON, return empty array
            $this->attributes['attributes'] = json_encode([]);
            return;
        }
        
        if (is_array($value)) {
            // Nếu là array, convert thành JSON
            $this->attributes['attributes'] = json_encode($value);
            return;
        }
        
        // Default: empty array
        $this->attributes['attributes'] = json_encode([]);
    }
    
    /**
     * Accessor: Ensure attributes is always returned as array
     */
    protected function getAttributesAttribute($value)
    {
        // Luôn trả về array
        if (is_null($value)) {
            return [];
        }
        
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                return $decoded;
            }
            // Nếu không phải JSON, return empty
            return [];
        }
        
        if (is_array($value)) {
            return $value;
        }
        
        return [];
    }
}
