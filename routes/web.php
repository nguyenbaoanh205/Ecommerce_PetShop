<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Admin\CartItemController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\ClientHomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// trang khách 
Route::get('/', function () {
    return view('client.index');
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
    Route::get('/home', [ClientHomeController::class, 'index']) -> name('home');
    Route::get('/product-detail/{id}',[ClientHomeController::class, 'productDetail'])->name('product-detail');
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

    // User Routes
    Route::resource('admin/users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy'
    ]);

    // Order Routes
    Route::resource('admin/orders', OrderController::class)->names([
        'index' => 'admin.orders.index',
        'show' => 'admin.orders.show',
        'update' => 'admin.orders.update',
        'destroy' => 'admin.orders.destroy'
    ]);

    // Order Item Routes
    Route::resource('admin/order-items', OrderItemController::class)->names([
        'index' => 'admin.order-items.index',
        'show' => 'admin.order-items.show',
        'update' => 'admin.order-items.update',
        'destroy' => 'admin.order-items.destroy'
    ]);

    // Cart Item Routes
    Route::resource('admin/cart-items', CartItemController::class)->names([
        'index' => 'admin.cart-items.index',
        'show' => 'admin.cart-items.show',
        'update' => 'admin.cart-items.update',
        'destroy' => 'admin.cart-items.destroy'
    ]);

    // Review Routes
    Route::resource('admin/reviews', ReviewController::class)->names([
        'index' => 'admin.reviews.index',
        'show' => 'admin.reviews.show',
        'update' => 'admin.reviews.update',
        'destroy' => 'admin.reviews.destroy'
    ]);
});


// logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
}) ->name('logout');