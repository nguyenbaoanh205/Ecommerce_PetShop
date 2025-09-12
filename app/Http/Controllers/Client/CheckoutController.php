<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function showForm()
    {
        $user = Auth::user();
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        $categories = Category::query()->where('status', 1)->where('type', 1)->get();
        return view('client.checkout.form', compact('user', 'cartItems', 'categories'));
    }

    public function placeOrder(Request $request)
    {
        // Validate dữ liệu shipping
        if ($request->has('different_address')) {
            $request->validate([
                'recipient_name' => 'required|string|max:255',
                'recipient_phone' => 'required|string|max:20',
                'recipient_address' => 'required|string|max:500',
                'shipping_note' => 'nullable|string|max:1000',
            ]);
        } else {
            $request->validate([
                'shipping_name' => 'required|string|max:255',
                'shipping_phone' => 'required|string|max:20',
                'shipping_address' => 'required|string|max:500',
                'shipping_note' => 'nullable|string|max:1000',
            ]);
        }

        // Validate phương thức thanh toán
        $request->validate([
            'payment_method' => 'required|in:cod,pay',
        ]);

        // Lấy giỏ hàng
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Lấy thông tin shipping
        if ($request->has('different_address')) {
            $shippingName = $request->recipient_name;
            $shippingPhone = $request->recipient_phone;
            $shippingAddress = $request->recipient_address;
        } else {
            $shippingName = $request->shipping_name;
            $shippingPhone = $request->shipping_phone;
            $shippingAddress = $request->shipping_address;
        }

        // Tạo đơn hàng
        $order = Order::create([
            'user_id' => Auth::id(),
            'shipping_name' => $shippingName,
            'shipping_phone' => $shippingPhone,
            'shipping_address' => $shippingAddress,
            'shipping_note' => $request->shipping_note,
            'total_amount' => $total,
            'status' => 'pending',
            'payment_method' => $request->payment_method, // Lấy từ form
        ]);

        // Tạo chi tiết đơn hàng
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Xóa giỏ hàng
        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('cart.index')->with('success', 'Order placed successfully!');
    }
}
