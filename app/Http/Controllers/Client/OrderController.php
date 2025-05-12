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
        $categories = Category::query()-> where('status', 1) -> where('type', 1)->get();
        $userId = Auth::id();
        $cartItems = CartItem::with('product')->where('user_id', $userId)->get();
        $orders = Order::where('user_id', Auth::user()->id)
                      ->orderBy('created_at', 'desc')
                      ->paginate(10);
                      
        return view('client.orders.history', compact('orders', 'categories', 'cartItems'));
    }

    public function show(Order $order)
    {
        $categories = Category::query()-> where('status', 1) -> where('type', 1)->get();
        $userId = Auth::id();
        $cartItems = CartItem::with('product')->where('user_id', $userId)->get();
        return view('client.orders.show', compact('order', 'categories', 'cartItems'));
    }
} 