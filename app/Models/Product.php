<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'domain', 'name', 'slug', 'thumbnail', 'description', 'warranty_policy',
        'product_category_id', 'product_group_id', 'group_tag',
        'type', 'api_provider_id', 'api_service_id', 'process_type',
        'cost_price', 'price', 'price_1', 'price_2',
        'price_percent', 'price_1_percent', 'price_2_percent',
        'min', 'max', 'sync', 'status', 'position',
    ];

    protected $casts = [
        'sync' => 'boolean',
        'cost_price' => 'decimal:10',
        'price'      => 'decimal:10',
        'price_1'    => 'decimal:10',
        'price_2'    => 'decimal:10',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function group()
    {
        return $this->belongsTo(ProductGroup::class, 'product_group_id');
    }

    public function provider()
    {
        return $this->belongsTo(ApiProvider::class, 'api_provider_id');
    }
}
