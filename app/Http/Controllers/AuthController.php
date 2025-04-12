<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credintials = $request -> validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credintials)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect('/admin') -> with('success', 'Đăng nhập thành công');
            }else{
                return redirect('/home') -> with('success', 'Đăng nhập thành công');
            }
        }else{
            return redirect('/login') -> with('error', 'Sai tên email hoặc mật khẩu chưa đúng');
        }
    }
}
