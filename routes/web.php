<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Admin\CartItemController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductImportController;


use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\ResetPasswordController;


use App\Http\Controllers\Client\ClientHomeController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\WishlistController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'formRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('auth.facebook.redirect');
Route::get('/auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [ClientHomeController::class, 'index'])->name('home');
Route::get('/product-detail/{id}', [ClientHomeController::class, 'productDetail'])->name('product-detail');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'showForm'])->name('checkout.form');
Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place');

Route::get('/orders/history', [ClientOrderController::class, 'history'])->name('orders.history');
Route::get('/orders/{order}', [ClientOrderController::class, 'show'])->name('orders.show');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::delete('/wishlist/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Products Import
    Route::get('products/import', [ProductImportController::class, 'index'])->name('products.import.index');
    Route::post('products/import', [ProductImportController::class, 'import'])->name('products.import.store');

    // Products
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Users
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Orders
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('orders/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

    // Order Items
    Route::get('order-items', [OrderItemController::class, 'index'])->name('order-items.index');
    Route::get('order-items/{id}', [OrderItemController::class, 'show'])->name('order-items.show');
    Route::put('order-items/{id}', [OrderItemController::class, 'update'])->name('order-items.update');
    Route::delete('order-items/{id}', [OrderItemController::class, 'destroy'])->name('order-items.destroy');

    // Cart Items
    Route::get('cart-items', [CartItemController::class, 'index'])->name('cart-items.index');
    Route::get('cart-items/{id}', [CartItemController::class, 'show'])->name('cart-items.show');
    Route::put('cart-items/{id}', [CartItemController::class, 'update'])->name('cart-items.update');
    Route::delete('cart-items/{id}', [CartItemController::class, 'destroy'])->name('cart-items.destroy');

    // Reviews
    Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('reviews/{id}', [ReviewController::class, 'show'])->name('reviews.show');
    Route::put('reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Banners
    Route::get('banners', [BannerController::class, 'index'])->name('banners.index');
    Route::get('banners/create', [BannerController::class, 'create'])->name('banners.create');
    Route::post('banners', [BannerController::class, 'store'])->name('banners.store');
    Route::get('banners/{id}/edit', [BannerController::class, 'edit'])->name('banners.edit');
    Route::put('banners/{id}', [BannerController::class, 'update'])->name('banners.update');
    Route::delete('banners/{id}', [BannerController::class, 'destroy'])->name('banners.destroy');

    // Posts
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Contacts
    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    // Route::get('contacts/{id}', [AdminContactController::class, 'show'])->name('contacts.show');
    // Route::delete('contacts/{id}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
});
