<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductWarehouse extends Model
{
    protected $fillable = ['name', 'domain', 'position'];

    public function goods()
    {
        return $this->hasMany(ProductGoods::class, 'warehouse_id');
    }

    public function availableGoods()
    {
        return $this->hasMany(ProductGoods::class, 'warehouse_id')->where('used', false);
    }
}
