<?php

namespace App\Http\Controllers\backend\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\AuthRepositoryInterface;


class AdminAuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $auth;
   
   

    public function __construct(AuthRepositoryInterface $auth)
    {
        $this->auth = $auth;
        // $this->middleware('guest:admins')->except('logout');
    }

    public function form()
    {
       return $this->auth->form();
    }

    public function login(Request $request)
    {
       
        $guard=$this->auth->login($request,'admins');

        if($guard == 'admins'){
            return redirect()->route('dashboard');
         }elseif(!$guard == 'admins'){
             return redirect()->url('/');
         }else{

             return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
         }
       
    }

}
