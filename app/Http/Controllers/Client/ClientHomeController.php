<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientHomeController extends Controller
{
    public function index()
    {
        $product_reviews = Product::with('reviews')->orderBy('id', 'desc')->get();
        $product_list = Product::with('category')->inRandomOrder()->take(8)->get();
        $categories = Category::query()->where('status', 1)->where('type', 1)->get();
        $product_bestselling = Product::with('category')->where('discount_price', '>', 0)->orderBy('discount_price', 'desc')->take(8)->get();

        $userId = Auth::id();
        $cartItems = CartItem::with('product')->where('user_id', $userId)->get();

        $cartCount = $cartItems->count();

        $highly_rated_product = $product_reviews->filter(function ($product) {
            return $product->reviews->avg('rating') > 3;
        })->take(8);
        $reviews = Review::all();
        $posts = Post::where('status', 1)->orderBy('created_at', 'desc')->take(3)->get();
        return view('client.home', compact('product_list', 'highly_rated_product', 'reviews', 'categories', 'posts', 'cartItems', 'cartCount', 'product_bestselling'));
    }

    public function productDetail($id)
    {
        $product = Product::with('category')->where('id', $id)->firstOrFail();
        $categories = Category::query()->where('status', 1)->where('type', 1)->get();
        $reviews = Review::with('user')->limit(2)->get();

        $userId = Auth::id();
        $cartItems = CartItem::with('product')->where('user_id', $userId)->get();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();

        return view('client.product-detail', compact('product', 'reviews', 'relatedProducts', 'categories', 'cartItems'));
    }
}
