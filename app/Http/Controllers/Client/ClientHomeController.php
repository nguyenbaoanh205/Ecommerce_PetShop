<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ClientHomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category') -> orderby('created_at', 'desc')->get();
        $categories = Category::all();
        $reviews = Review::all();
        return view('client.home', compact('products', 'reviews', 'categories'));
    } 
    public function productDetail($id)
    {
        // Lấy sản phẩm cụ thể theo ID
        $product = Product::with('category')->where('id', $id)->firstOrFail();
        
        // Lấy tất cả đánh giá
        $reviews = Review::with('user')->limit(2)->get();
        
        // Lấy các sản phẩm liên quan (ví dụ: cùng danh mục, giới hạn 4 sản phẩm)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id) // Loại trừ sản phẩm hiện tại
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('client.product-detail', compact('product', 'reviews', 'relatedProducts'));
    }
}
