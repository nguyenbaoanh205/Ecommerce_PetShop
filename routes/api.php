<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', function () {
    return User::all();
});


Route::get('/products', function () {
    return \App\Models\Product::all();
});

