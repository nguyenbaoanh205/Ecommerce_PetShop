<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientHomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.list');
}); 


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
    Route::get('/admin', [AdminDashboardController::class, 'index']);
});
