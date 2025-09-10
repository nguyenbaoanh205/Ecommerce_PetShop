<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'payment_method',
        'shipping_name',
        'shipping_address',
        'shipping_phone',
        'shipping_note',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function getNextStatuses(): array
    {
        $flows = [
            'pending'    => ['confirmed', 'cancelled'],
            'confirmed'  => ['processing', 'cancelled'],
            'processing' => ['shipped', 'cancelled'],
            'shipped'    => ['delivered', 'failed'],
            'delivered'  => ['completed', 'returned'],
            'failed'     => ['refunded', 'cancelled'],
            'returned'   => ['refunded'],
            'refunded'   => [],
            'completed'  => [],
            'cancelled'  => [],
        ];

        return $flows[$this->status] ?? [];
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
