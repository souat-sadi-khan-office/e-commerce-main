<?php

namespace App\Http\Controllers\Admin\Auth;

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
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        // return view('backend.auth.login');
        return $this->authRepository->form();
    }

    public function login(Request $request)
    {
        // $credentials = $request->only('email', 'password');

        // if (Auth::guard('admin')->attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->route('admin.dashboard');
        // }

        $guard = $this->authRepository->login($request, 'admin');

        if ($guard) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        // Helpers::logout('admin');
        $this->authRepository->logout('admin');  
        
        return redirect()->route('admin.login');
    }

}
