<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->where('type', 2)->where('status', 1)->get();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/posts', $imageName);
            $data['image'] = 'posts/' . $imageName;
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::query()->where('type', 2)->where('status', 1)->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/posts', $imageName);
            $data['image'] = 'posts/' . $imageName;
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Delete image if exists
        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }
} 