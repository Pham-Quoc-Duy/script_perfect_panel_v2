<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketSubject extends Model
{
    protected $fillable = [
        'category',
        'subcategory',
        'show_message_only',
        'required_fields',
        'status',
        'sort_order'
    ];

    protected $casts = [
        'required_fields' => 'array',
        'status' => 'integer',
        'show_message_only' => 'boolean'
    ];

    public function getRequiredFieldsAttribute($value)
    {
        if (is_null($value)) {
            return [];
        }
        if (is_array($value)) {
            return $value;
        }
        // Nếu là string JSON, decode nó
        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : [];
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'subject_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function getRequiredFieldsForForm()
    {
        return $this->required_fields ?? [];
    }

    public function getDisplayNameAttribute()
    {
        if ($this->subcategory) {
            return $this->category . ' - ' . $this->subcategory;
        }
        return $this->category;
    }

    // Get unique categories
    public static function getCategories()
    {
        return self::active()->select('category')->distinct()->orderBy('category')->pluck('category');
    }

    // Get subcategories by category
    public static function getSubcategoriesByCategory($category)
    {
        return self::active()->where('category', $category)->orderBy('sort_order')->get();
    }

    // Check if category has subcategories
    public static function categoryHasSubcategories($category)
    {
        return self::active()
            ->where('category', $category)
            ->whereNotNull('subcategory')
            ->exists();
    }

    // Get all subjects grouped by category
    public static function getGroupedByCategory()
    {
        return self::active()
            ->orderBy('category')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');
    }

    // Check if category requires message only
    public static function isMessageOnlyCategory($category)
    {
        return in_array(strtolower($category), ['payments', 'other']);
    }

    // Get category with subcategories
    public static function getCategoryWithSubcategories($category)
    {
        return self::active()
            ->where('category', $category)
            ->orderBy('sort_order')
            ->get();
    }

    // Get all active subjects for dropdown
    public static function getForDropdown()
    {
        return self::active()
            ->orderBy('category')
            ->orderBy('sort_order')
            ->get()
            ->map(function ($subject) {
                return [
                    'id' => $subject->id,
                    'display_name' => $subject->display_name,
                    'category' => $subject->category,
                    'subcategory' => $subject->subcategory,
                    'show_message_only' => $subject->show_message_only,
                    'required_fields' => $subject->required_fields
                ];
            });
    }
}