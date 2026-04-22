<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGoods extends Model
{
    protected $fillable = ['warehouse_id', 'content', 'used'];

    protected $casts = ['used' => 'boolean'];

    public function warehouse()
    {
        return $this->belongsTo(ProductWarehouse::class, 'warehouse_id');
    }
}
