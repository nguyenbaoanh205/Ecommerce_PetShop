<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $cartItems = Controller::GetMenu()['cartItems'];
        $cartCount = Controller::GetMenu()['cartCount'];
        $reviews = Review::all();
        $products = Product::with('category')->inRandomOrder()->paginate(16);

        return view('client.shop.index', compact( 'cartItems', 'cartCount', 'reviews', 'products'));
    }
}
