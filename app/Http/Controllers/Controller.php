<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    public static function GetMenu()
    {
        $userId = Auth::id();
        $cartItems = CartItem::with('product')->where('user_id', $userId)->get();
        $cartCount = $cartItems->count();
            
        return ['cartItems' => $cartItems,'cartCount' => $cartCount];
    }
}
