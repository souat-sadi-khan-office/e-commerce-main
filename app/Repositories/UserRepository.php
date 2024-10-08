<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Interface\UserRepositoryInterface;


class UserRepository implements UserRepositoryInterface
{
    public function index($request)
    {
        $user = Auth::guard('customer')->user();
        dd($user);
    }
    
}