<?php

namespace App\Http\Controllers\Client;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\PaymentIntent;
use Stripe\Stripe;

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
            $shippingName = $request->recipient_name;
            $shippingPhone = $request->recipient_phone;
            $shippingAddress = $request->recipient_address;
            $shippingNote = $request->shipping_note;
        } else {
            $request->validate([
                'shipping_name' => 'required|string|max:255',
                'shipping_phone' => 'required|string|max:20',
                'shipping_address' => 'required|string|max:500',
                'shipping_note' => 'nullable|string|max:1000',
            ]);
            $shippingName = $request->shipping_name;
            $shippingPhone = $request->shipping_phone;
            $shippingAddress = $request->shipping_address;
            $shippingNote = $request->shipping_note;
        }

        // Validate phương thức thanh toán
        $request->validate([
            'payment_method' => 'required|in:cod,pay',
        ]);

        // Lấy giỏ hàng
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Nếu chọn thanh toán online (Stripe Checkout)
        if ($request->payment_method === 'pay') {
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $total * 100,
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ]);

            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Order #' . uniqid(),
                        ],
                        'unit_amount' => $total * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('cart.index') . '?success=true',
                'cancel_url' => route('checkout.form'),
            ]);

            // Tạo đơn hàng và lưu Checkout Session ID tạm
            $order = Order::create([
                'user_id' => Auth::id(),
                'shipping_name' => $shippingName,
                'shipping_phone' => $shippingPhone,
                'shipping_address' => $shippingAddress,
                'shipping_note' => $shippingNote,
                'total_amount' => $total,
                'status' => 'confirmed', // chờ thanh toán
                'payment_method' => 'pay',
                'stripe_payment_intent_id' => $paymentIntent->id, // lưu tạm session ID
            ]);

            event(new OrderCreated($order));

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

            // Redirect tới Stripe Checkout
            return redirect($session->url);
        }

        // Nếu chọn COD
        $order = Order::create([
            'user_id' => Auth::id(),
            'shipping_name' => $shippingName,
            'shipping_phone' => $shippingPhone,
            'shipping_address' => $shippingAddress,
            'shipping_note' => $shippingNote,
            'total_amount' => $total,
            'status' => 'pending',
            'payment_method' => 'cod',
            'stripe_payment_intent_id' => null,
        ]);

        event(new OrderCreated($order));

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('cart.index')->with('success', 'Order placed successfully!');
    }
}
