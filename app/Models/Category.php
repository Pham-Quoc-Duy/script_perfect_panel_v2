<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['platform_id', 'name', 'image', 'position', 'status', 'domain'];

    protected $casts = [
        'name' => 'json',
        'status' => 'boolean',
        'position' => 'integer'
    ];

    protected $appends = ['localized_name', 'image_url'];

    // Relationships
    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
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

    /**
     * Get localized name
     */
    public function getName(?string $lang = null): string
    {
        $lang = $lang ?? (auth()->check() ? auth()->user()->lang : 'en');
        $data = $this->name;
        return is_array($data) ? ($data[$lang] ?? $data['en'] ?? reset($data) ?? '') : ($data ?? '');
    }

    public function getLocalizedNameAttribute(): string
    {
        return $this->getName();
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        return filter_var($this->image, FILTER_VALIDATE_URL)
            ? $this->image
            : asset('storage/categories/' . $this->image);
    }

    // Boot method
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $category) {
            if (!$category->position) {
                $category->position = static::where('platform_id', $category->platform_id)
                    ->max('position') + 1;
            }
        });
    }
}