<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // ...existing code...

    protected function authenticated(Request $request, $user)
    {
        // Assuming your User model has a 'role' attribute
        if ($user->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        }
        // Redirect non-admin users elsewhere
        return redirect()->intended('/home');
    }

    // ...existing code...
}
