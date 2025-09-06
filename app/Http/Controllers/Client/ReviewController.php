<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'product_id' => 'required|exists:products,id',
    //         'rating'     => 'required|integer|min:1|max:5',
    //         'comment'    => 'required|string|max:1000',
    //     ]);

    //     Review::create([
    //         'product_id' => $request->product_id,
    //         'user_id'    => Auth::id(),
    //         'rating'     => $request->rating,
    //         'comment'    => $request->comment,
    //     ]);

    //     return back()->with('success', 'Thank you for your review!');
    // }
}