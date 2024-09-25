<?php

namespace App\Repositories;

use App\Repositories\Interface\UserRepositoryInterface;


class UserRepository implements UserRepositoryInterface
{
    public function index($request)
    {
        return 1;
    }
    
}