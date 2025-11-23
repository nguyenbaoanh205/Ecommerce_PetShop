<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $orderId;
    public $userName;

    public function __construct($order)
    {
        $this->orderId = $order->id;
        $this->userName = $order->user->name ?? 'Khách hàng';
    }

    public function broadcastOn()
    {
        // Kênh public, admin chỉ cần nghe
        return new Channel('admin.orders');
    }

    public function broadcastAs()
    {
        return 'order.created';
    }

    public function broadcastWith()
    {
        return [
            'orderId' => $this->orderId,
            'userName' => $this->userName,
        ];
    }
}
