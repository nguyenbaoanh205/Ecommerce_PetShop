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
        $products = Product::with(['category', 'reviews'])-> orderBy('id', 'desc')->get();
        $categories = Category::query()-> where('status', 1) -> where('type', 1)->get();
        $userId = Auth::id();
        $cartItems = CartItem::with('product')->where('user_id', $userId)->get();
        $highly_rated_product = $products->filter(function ($product) {
            return $product->reviews->avg('rating') > 3;
        });
        $reviews = Review::all();
        $posts = Post::where('status', 1)->orderBy('created_at', 'desc')->take(3)->get();
        return view('client.home', compact('products', 'highly_rated_product', 'reviews', 'categories', 'posts', 'cartItems'));
    } 
    public function productDetail($id)
    {
        $product = Product::with('category')->where('id', $id)->firstOrFail();
        $categories = Category::query()-> where('status', 1) -> where('type', 1)->get();
        $reviews = Review::with('user')->limit(2)->get();
        
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->orderBy('id', 'desc') 
            ->take(4)
            ->get();

        return view('client.product-detail', compact('product', 'reviews', 'relatedProducts', 'categories'));
    }
}
