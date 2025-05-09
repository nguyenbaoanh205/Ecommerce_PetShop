<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function index()
    {
        $categories = Category::query()-> where('status', 1) -> where('type', 1)->get();
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('client.wishlist.index', compact('wishlists', 'categories'));
    }
    public function add(Request $request)
    {
        $productId = $request->input('product_id');

        // Kiểm tra xem đã có chưa
        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'added_at' => now(),
            ]);
        }

        return back()->with('success', 'Đã thêm vào danh sách yêu thích!');
    }

    public function remove($id)
    {
        $wishlist = Wishlist::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $wishlist->delete();

        return back()->with('success', 'Đã xoá khỏi danh sách yêu thích');
    }
}
