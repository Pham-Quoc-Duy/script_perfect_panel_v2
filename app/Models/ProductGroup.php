<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    protected $fillable = ['name', 'domain', 'position'];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_group_id');
    }
}
