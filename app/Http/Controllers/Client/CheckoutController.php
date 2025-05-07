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
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        $categories = Category::query()-> where('status', 1) -> where('type', 1)->get();
        return view('client.checkout.form', compact('cartItems', 'categories'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'shipping_name' => 'required|string',
            'shipping_phone' => 'required',
            'shipping_address' => 'required|string',
            'shipping_note' => 'nullable|string',
        ]);

        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        $order = Order::create([
            'user_id' => Auth::id(),
            'shipping_name' => $request->shipping_name,
            'shipping_phone' => $request->shipping_phone,
            'shipping_address' => $request->shipping_address,
            'shipping_note' => $request->shipping_note,
            'total_amount' => $total,
            'status' => 'pending',
            'payment_method' => 'cod',
        ]);
        // dd($order);
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Xoá giỏ hàng sau khi đặt hàng
        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('cart.index')->with('success', 'Đặt hàng thành công!');
    }
}
