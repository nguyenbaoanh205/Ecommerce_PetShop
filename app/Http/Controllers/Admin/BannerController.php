<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url|max:255',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/banners'), $imageName);
            $imagePath = 'uploads/banners/' . $imageName;
        }

        Banner::create([
            'title' => $request->title,
            'image' => $imagePath,
            'link' => $request->link,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url|max:255',
            'status' => 'required|boolean',
        ]);

        $data = [
            'title' => $request->title,
            'link' => $request->link,
            'status' => $request->status,
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($banner->image) {
                $oldImagePath = public_path($banner->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/banners'), $imageName);
            $data['image'] = 'uploads/banners/' . $imageName;
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            $imagePath = public_path($banner->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner deleted successfully.');
    }
} 