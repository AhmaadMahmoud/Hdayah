<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    const STATUS_PENDING_PAYMENT = 'pending_payment';
    const STATUS_CASH_PENDING = 'cash_pending';
    const STATUS_PAID = 'paid';
    const STATUS_FAILED = 'failed';

    protected $fillable = [
        'product_id',
        'user_id',
        'total',
        'payment_method',
        'status',
        'gateway_order_id',
        'gateway_payment_id',
        'meta',
    ];

    protected $casts = [
        'total' => 'float',
        'meta' => 'array',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
