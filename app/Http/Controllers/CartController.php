<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $userId = Auth::id();
        $categories = Category::query()-> where('status', 1) -> where('type', 1)->get();
        $cartItems = CartItem::with('product')->where('user_id', $userId)->get();

        return view('client.cart.index', compact('cartItems', 'categories'));
    }

    // Thêm sản phẩm vào giỏ
    public function add(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->input('product_id');

        $cartItem = CartItem::where('user_id', $userId)
                            ->where('product_id', $productId)
                            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->input('quantity', 1));
        } else {
            CartItem::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $request->input('quantity', 1),
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Đã thêm vào giỏ hàng');
    }

    // Cập nhật số lượng
    public function update(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->update(['quantity' => $request->input('quantity')]);

        return redirect()->route('cart.index')->with('success', 'Cập nhật thành công');
    }

    // Xoá khỏi giỏ
    public function remove($id)
    {
        CartItem::destroy($id);
        return redirect()->route('cart.index')->with('success', 'Đã xoá sản phẩm khỏi giỏ hàng');
    }
}
