<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login', ['role' => 'admin']);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['role'] = 'admin';

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials or not an admin.',
        ]);
    }
}
