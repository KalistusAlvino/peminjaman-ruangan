<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.auth');
    }
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'username' => 'required|string',
                'password' => 'required|string|min:8',
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                if (Auth::user()->role->role_name === 'admin') {
                    return redirect()->intended('dashboard/bookings');
                } else {
                    return redirect()->intended('dashboard/user-bookings');
                }
            }
            return back()->withErrors([
                'error' => 'Username or password is incorrect'
            ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'An error occurred during login. Please try again.'
            ]);
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('index');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'An error occurred during logout. Please try again.'
            ]);
        }
    }
}
