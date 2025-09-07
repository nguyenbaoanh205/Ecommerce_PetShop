<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cartItems = Controller::GetMenu()['cartItems'];
        $cartCount = Controller::GetMenu()['cartCount'];
        $categories = Category::query()->where('status', 1)->where('type', 1)->get();

        return view('client.cart.index', compact('cartItems', 'categories', 'cartCount'));
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

        return back()->with('success', 'Added to cart successfully.');
    }

    // Cập nhật số lượng
    public function update(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->update(['quantity' => $request->input('quantity')]);

        return back()->with('success', 'Cập nhật thành công');
    }

    // Xoá khỏi giỏ
    public function remove($id)
    {
        CartItem::destroy($id);
        return back()->with('success', 'Remove from cart successfully.');
    }
    // Mua ngay
    public function buyNow(Request $request)
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

        // Sau khi thêm vào giỏ thì chuyển thẳng sang trang checkout
        return redirect()->route('checkout.form');
    }
}
