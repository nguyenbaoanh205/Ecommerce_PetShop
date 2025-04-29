<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientHomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.list');
}); 

// register
Route::get('/register', function () {
    return view('auth.register');
}) -> name('register');
Route::post('/register', [AuthController::class, 'register']) -> name('register');

// login
Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');

// client
Route::middleware('client')->group(function () {
    Route::get('/home', [ClientHomeController::class, 'index']);
});



// admin
Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin');
    
    // Category Routes
    Route::resource('admin/categories', CategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy'
    ]);

    // Product Routes
    Route::resource('admin/products', ProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy'
    ]);
});


// logout
Route::post('/logout', function () {
    Auth::logout();
    return view('auth.login');
}) ->name('logout');