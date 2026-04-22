<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'position', 'status', 'domain'];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function services()
    {
        return $this->hasManyThrough(Service::class, Category::class);
    }

    /**
     * Scope for ordering by position
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('position', 'asc');
    }
}