<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Post::with('category')
            ->where('status', 1)
            ->latest()
            ->get();
        $userId = Auth::id();
        $cartItems = CartItem::with('product')->where('user_id', $userId)->get();
        return view('client.blogs.index', compact('blogs', 'cartItems'));
    }

    public function show($slug)
    {
        $blog = Post::with('category')->where('slug', $slug)->firstOrFail();
        $relatedBlogs = Post::where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->take(3)
            ->get();
        return view('client.blog.show', compact('blog', 'relatedBlogs'));
    }
}
