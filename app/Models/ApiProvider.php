<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiProvider extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'name',
        'type',
        'link',
        'api_key',
        'rate_api',
        'balance',
        'fixed_decimal',
        'warning',
        'currency',
        'note',
        'position',
        'status',
        'domain'
    ];

    protected $casts = [
        'balance' => 'decimal:4',
        'status' => 'boolean',
    ];

    // Relationships
    public function services()
    {
        return $this->hasMany(Service::class, 'provider_name', 'name');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'provider_name', 'name');
    }
}