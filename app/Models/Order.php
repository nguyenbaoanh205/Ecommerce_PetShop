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
public function getNextStatuses()
{
    $statuses = ['pending','confirmed','shipped','completed','returned','cancelled'];
    $currentIndex = array_search($this->status, $statuses);

    if ($currentIndex === false || in_array($this->status, ['completed','returned','cancelled'])) {
        return []; // không còn trạng thái tiếp theo
    }

    // chỉ trạng thái tiếp theo thôi, không cho nhảy nhiều bước
    return [$statuses[$currentIndex + 1]];
}

}
