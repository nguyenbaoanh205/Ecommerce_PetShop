<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with(['user', 'product'])->latest()->get();
        return view('admin.cart-items.index', compact('cartItems'));
    }

    public function show(CartItem $cartItem)
    {
        $cartItem->load(['user', 'product']);
        return view('admin.cart-items.show', compact('cartItem'));
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->route('admin.cart-items.index')
            ->with('success', 'Cart item updated successfully.');
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('admin.cart-items.index')
            ->with('success', 'Cart item deleted successfully.');
    }
} 