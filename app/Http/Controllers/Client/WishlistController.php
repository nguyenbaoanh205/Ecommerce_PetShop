<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function index()
    {
        $categories = Category::query()->where('status', 1)->where('type', 1)->get();
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        $userId = Auth::id();
        $cartItems = CartItem::with('product')->where('user_id', $userId)->get();
        return view('client.wishlist.index', compact('wishlists', 'categories', 'cartItems'));
    }
    public function add(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->product_id;

        // Kiểm tra sản phẩm đã có trong wishlist chưa
        $exists = Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($exists) {
            return redirect()->back()->with('info', 'Product already exists in wishlist.');
        }

        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist successfully.');
    }


    public function remove($id)
    {
        $wishlist = Wishlist::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $wishlist->delete();

        return back()->with('success', 'Removed from wishlist successfully!');
    }
}
