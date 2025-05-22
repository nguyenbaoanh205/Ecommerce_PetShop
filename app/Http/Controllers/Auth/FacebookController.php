<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $fbUser = Socialite::driver('facebook')->fields([
                'name',
                'email'
            ])->user();

            $user = User::firstOrCreate(
                ['email' => $fbUser->getEmail()],
                [
                    'name' => $fbUser->getName(),
                    'password' => bcrypt(Str::random(16)),
                    'provider' => 'facebook',
                    'provider_id' => $fbUser->getId(),
                    // 'avatar' => $fbUser->getAvatar(), // Nếu muốn lưu avatar
                ]
            );
            // Nếu user đã tồn tại nhưng chưa có provider
            if (!$user->provider || !$user->provider_id) {
                $user->update([
                    'provider' => 'facebook',
                    'provider_id' => $fbUser->getId(),
                ]);
            }

            Auth::login($user);

            return redirect('home'); // hoặc route nào bạn muốn

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Đăng nhập Facebook thất bại: ' . $e->getMessage());
        }
    }
}
