<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function history()
    {
        $categories = Category::query()->where('status', 1)->where('type', 1)->get();
        $userId = Auth::id();
        $cartItems = CartItem::with('product')->where('user_id', $userId)->get();
        $orders = Order::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('client.orders.history', compact('orders', 'categories', 'cartItems'));
    }

    public function show(Order $order)
    {
        $categories = Category::query()->where('status', 1)->where('type', 1)->get();
        $userId = Auth::id();
        $cartItems = CartItem::with('product')->where('user_id', $userId)->get();
        return view('client.orders.show', compact('order', 'categories', 'cartItems'));
    }
    public function receive(Order $order)
    {
        // Kiểm tra đúng user
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('orders.history')
                ->with('error', 'You are not authorized to confirm this order.');
        }

        // Chỉ cho phép xác nhận khi trạng thái là "delivered"
        if ($order->status !== 'delivered') {
            return redirect()->back()
                ->with('error', 'Order must be in delivered status to confirm.');
        }

        // Cập nhật trạng thái thành completed
        $order->update(['status' => 'completed']);

        return redirect()->route('orders.history')
            ->with('success', 'Order confirmed successfully.');
    }
    public function review(Order $order)
    {
        // đảm bảo chỉ chủ sở hữu đơn hàng được review
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::query()
            ->where('status', 1)
            ->where('type', 1)
            ->get();

        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('client.orders.review', compact('order', 'categories', 'cartItems'));
    }
    public function submitReview(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $orderItem = $order->orderItems()->first(); // lấy sản phẩm đầu tiên của đơn
        $order->reviews()->create([
            'user_id' => Auth::id(),
            'product_id' => $orderItem->product_id, // thêm product_id
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);


        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Thank you for your review!');
    }
}
