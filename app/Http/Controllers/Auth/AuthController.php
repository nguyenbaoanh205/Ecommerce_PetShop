<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function formRegister(){
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'address' => 'required'
        ],
        [
            'email.unique' => 'email already exists',
        ]
    );
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address
        ]);
        return redirect('/login')->with('success', 'Register successfully');
    }
    public function formLogin(){
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credintials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $remember = $request->filled('remember');

        if (Auth::attempt($credintials, $remember)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect('/admin')->with('success', 'Login successfully');
            } else {
                return redirect('/')->with('success', 'Login successfully');
            }
        } else {
            return redirect('/login')->with('error', 'Email or password is incorrect');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
