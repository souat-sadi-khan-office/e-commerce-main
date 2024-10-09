<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\CPU\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interface\AuthRepositoryInterface;

class LoginController extends Controller
{

    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function index()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('dashboard');
        }

        return $this->authRepository->customer_login_form();
    }

    public function login(Request $request)
    {
        $guard = $this->authRepository->login($request, 'customer');

        if ($guard) {
            $request->session()->regenerate();
            return response()->json([
                'status' => true, 
                'goto' => route('dashboard'),
                'message' => "Login successfully"
            ]);
        }

        return response()->json([
            'status' => false, 
            'message' => "The provided credentials do not match our records"
        ]);
    }

    public function logout()
    {
        // Helpers::logout('admin');
        $this->authRepository->logout('customer');  
        
        return response()->json([
            'status' => true, 
            'goto' => route('home'),
            'message' => "Logout successful"
        ]);
    }

}
