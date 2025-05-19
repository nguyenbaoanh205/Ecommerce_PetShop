<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt('google_login'), // hoặc random()
                    // 'email_verified_at' => now(),
                    // Có thể thêm avatar, etc.
                ]
            );

            Auth::login($user);

            return redirect()->route('home'); // chuyển hướng sau khi đăng nhập

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}
