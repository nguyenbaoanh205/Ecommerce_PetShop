<?php

namespace App\Http\Controllers\Admin;

use App\Events\OrderStatusUpdated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('orderItems.product');
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $nextStatuses = $order->getNextStatuses();

        if (empty($nextStatuses)) {
            return redirect()->back()
                ->with('error', 'This order cannot be updated anymore.');
        }

        // Nếu admin cố tình gửi completed thì chặn lại
        if ($request->status === 'completed') {
            return redirect()->back()
                ->with('error', 'Only customers can confirm completion of the order.');
        }

        // Validation: chỉ cho phép update sang trạng thái tiếp theo
        $request->validate([
            'status' => 'required|in:' . implode(',', $nextStatuses)
        ]);

        $order->update([
            'status' => $request->status
        ]);

        // Log trước khi fire event
        // Log::info('Firing OrderStatusUpdated event', [
        //     'orderId' => $order->id,
        //     'newStatus' => $request->status,
        //     'userId' => $order->user_id
        // ]);

        // Fire event
        event(new OrderStatusUpdated($order->id, $request->status));

        // Log::info('OrderStatusUpdated event fired successfully');

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
