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

    // Category Routes
    Route::resource('categories', CategoryController::class)->names([
        'index' => 'categories.index',
        'create' => 'categories.create',
        'store' => 'categories.store',
        'edit' => 'categories.edit',
        'update' => 'categories.update',
        'destroy' => 'categories.destroy'
    ]);

    // Product Import
    Route::get('products/import', [ProductImportController::class, 'index']);
    Route::post('products/import', [ProductImportController::class, 'import'])->name('products.import');

    // Product Routes
    Route::resource('products', ProductController::class)->names([
        'index' => 'products.index',
        'create' => 'products.create',
        'store' => 'products.store',
        'edit' => 'products.edit',
        'update' => 'products.update',
        'destroy' => 'products.destroy'
    ]);

    // User Routes
    Route::resource('users', UserController::class)->names([
        'index' => 'users.index',
        'create' => 'users.create',
        'store' => 'users.store',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy'
    ]);

    // Order Routes
    Route::resource('orders', OrderController::class)->names([
        'index' => 'orders.index',
        'show' => 'orders.show',
        'update' => 'orders.update',
        'destroy' => 'orders.destroy'
    ]);

    // Order Item Routes
    Route::resource('order-items', OrderItemController::class)->names([
        'index' => 'order-items.index',
        'show' => 'order-items.show',
        'update' => 'order-items.update',
        'destroy' => 'order-items.destroy'
    ]);

    // Cart Item Routes
    Route::resource('cart-items', CartItemController::class)->names([
        'index' => 'cart-items.index',
        'show' => 'cart-items.show',
        'update' => 'cart-items.update',
        'destroy' => 'cart-items.destroy'
    ]);

    // Review Routes
    Route::resource('reviews', ReviewController::class)->names([
        'index' => 'reviews.index',
        'show' => 'reviews.show',
        'update' => 'reviews.update',
        'destroy' => 'reviews.destroy'
    ]);

    // Banner Routes
    Route::resource('banners', BannerController::class)->names([
        'index' => 'banners.index',
        'create' => 'banners.create',
        'store' => 'banners.store',
        'edit' => 'banners.edit',
        'update' => 'banners.update',
        'destroy' => 'banners.destroy'
    ]);

    // Post Routes
    Route::resource('posts', PostController::class)->names([
        'index' => 'posts.index',
        'create' => 'posts.create',
        'store' => 'posts.store',
        'show' => 'posts.show',
        'edit' => 'posts.edit',
        'update' => 'posts.update',
        'destroy' => 'posts.destroy'
    ]);

    // Contact Routes
    Route::resource('contacts', AdminContactController::class)->names([
        'index' => 'contacts.index',
        // 'show' => 'contacts.show',
        // 'destroy' => 'contacts.destroy'
    ]);
});



// logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
