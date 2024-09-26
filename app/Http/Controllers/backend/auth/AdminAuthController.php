<?php

namespace App\Http\Controllers\backend\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function form()
    {
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admins')->attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
    }
}
