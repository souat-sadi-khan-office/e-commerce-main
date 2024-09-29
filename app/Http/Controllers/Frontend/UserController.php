<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function index(Request $request){
        $users = $this->user->index($request);
        return $users;
    }
}
