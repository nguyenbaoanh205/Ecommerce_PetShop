<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class OrderStatusUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $orderId;
    public $status;

    public function __construct($orderId, $status)
    {
        $this->orderId = $orderId;
        $this->status = $status;
        
        // Log để debug
        // Log::info('OrderStatusUpdated event created', [
        //     'orderId' => $orderId,
        //     'status' => $status,
        //     'channel' => 'order.' . $orderId
        // ]);
    }

    public function broadcastOn()
    {
        return new PrivateChannel('order.' . $this->orderId);
    }

    public function broadcastAs()
    {
        return 'status.updated';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        $data = [
            'orderId' => $this->orderId,
            'status' => $this->status,
        ];
        
        // Log để debug
        // Log::info('OrderStatusUpdated broadcasting data', $data);
        
        return $data;
    }
}
