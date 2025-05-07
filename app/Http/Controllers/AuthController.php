<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'address' => 'required'
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address
        ]);
        return redirect('/login')->with('success', 'Đăng ký thành công');
    }
    public function login(Request $request)
    {
        $credintials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // Kiểm tra nếu người dùng muốn "Nhớ tôi"
        $remember = $request->filled('remember');

        if (Auth::attempt($credintials, $remember)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect('/admin')->with('success', 'Đăng nhập thành công');
            } else {
                return redirect('/home')->with('success', 'Đăng nhập thành công');
            }
        } else {
            return redirect('/login')->with('error', 'Sai tên email hoặc mật khẩu chưa đúng');
        }
    }
}
