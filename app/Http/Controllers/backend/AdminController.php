<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interface\AuthRepositoryInterface;

class AdminController extends Controller
{
    // private $auth;

    // public function __construct(AuthRepositoryInterface $auth)
    // {
    //     $this->auth = $auth;
    // }

    public function dashboard(Request $request) {
        dd("I'm on dashboard");
        dd(Auth::guard('admins')->check());
    }
}
