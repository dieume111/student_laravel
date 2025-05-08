<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('landingpage');
    }
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showDashboard()
    {
        return view('dashboard');
    }

   public function register(Request $request)
    {
    $validated = $request->validate([
        'user_name' => 'required|string|unique:users',
        'password' => 'required|min:2|confirmed',
    ]);
        $user = User::create([
            'user_name' => $validated['user_name'],
            'password' => Hash::make($validated['password']),
        ]);
        
        return redirect()->route('login')->with('success', 'Registration successful');

  }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Login successful');
        }
        return redirect()->route('dashboard')->with('sucessfull','Registration sucessful');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }     
}