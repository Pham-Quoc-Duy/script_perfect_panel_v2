<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductOrder extends Model
{
    protected $fillable = [
        'user_id', 'domain', 'product_id', 'provider_product_order_id',
        'status', 'amount', 'charge', 'quantity', 'note',
    ];

    protected $casts = [
        'amount' => 'decimal:4',
        'charge' => 'decimal:4',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'Completed'   => 'badge-success',
            'In progress' => 'badge-info',
            'Partial'     => 'badge-warning',
            'Pending'     => 'badge-secondary',
            'Awaiting'    => 'badge-secondary',
            'Manual'      => 'badge-primary',
            'Failed'      => 'badge-danger',
            'Canceled'    => 'badge-warning',
            default       => 'badge-secondary',
        };
    }}
