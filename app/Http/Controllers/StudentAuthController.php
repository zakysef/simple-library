<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StudentAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login', ['role' => 'student']);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['role'] = 'student';

        if (Auth::attempt($credentials)) {
            return redirect()->route('student.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials or not a student.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register', ['role' => 'student']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'student',
        ]);

        // Login user setelah register
        auth()->login($user);

        // Redirect ke dashboard siswa
        return redirect()->route('student.dashboard');
    }
}
