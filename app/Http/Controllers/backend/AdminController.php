<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\AuthRepositoryInterface;

class AdminController extends Controller
{
    private $auth;

    public function __construct(AuthRepositoryInterface $auth)
    {
        $this->auth = $auth;
    }

    public function index(Request $request){
        $auth= $this->auth->index($request);
        return $auth;
    }
}
