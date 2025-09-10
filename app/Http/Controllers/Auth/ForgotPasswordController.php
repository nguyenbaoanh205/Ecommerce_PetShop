<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Tạo token
        $token = Str::random(60) . '_' . time() . '_' . $request->email;

        // Lưu token vào bảng password_resets
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        // Gửi email với token
        // Mail::to($request->email)->send(new ResetPasswordMail($token, $request->email));

        // Gửi notification với token
        $user = User::where('email', $request->email)->first();
        $user->notify(new ResetPasswordNotification($token));

        return back()->with('success', 'Password reset email sent!');
    }
}
