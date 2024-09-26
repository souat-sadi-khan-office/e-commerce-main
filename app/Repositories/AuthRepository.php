<?php

namespace App\Repositories;

use Exception;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interface\AuthRepositoryInterface;


class AuthRepository implements AuthRepositoryInterface
{

    
    public function login( $request, $guard)
    {
        $cred = $request->only('email','password');

        if (Auth::guard($guard)->attempt($cred)) {
            return $guard;
        }
    
        return 0;
    }
    
    public function form(){
        return view('backend.auth.login');
    }
    
}