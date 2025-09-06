<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutUsController extends Controller
{
    public function index()
    {
        $cartItems = Controller::GetMenu()['cartItems'];
        $cartCount = Controller::GetMenu()['cartCount'];
        return view('client.aboutUs.index', compact('cartItems', 'cartCount'));
    }
}
