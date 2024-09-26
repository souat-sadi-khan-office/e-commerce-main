<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Interface\AuthRepositoryInterface;


class AuthRepository implements AuthRepositoryInterface
{
    public function login( $request, $guard)
    {
      
        if (!isset($request->email) || !isset($request['password'])) {
            dd($request,$request->email);
            return redirect()->back()->withErrors(['error' => 'Email and password are required.']);
        }
        $credintials=$request->only('email','password');
        // Attempt to authenticate the user
        if (Auth::guard($guard)->attempt($credintials)) {
 
            return $guard;
           
        }
    
        // If authentication fails
        return 0;
    }
    
    public function form(){
        return view('backend.auth.login');
    }
    
}