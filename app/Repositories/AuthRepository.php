<?php

namespace App\Repositories;

use App\Repositories\Interface\AuthRepositoryInterface;


class AuthRepository implements AuthRepositoryInterface
{
    public function index($request)
    {
        return 1;
    }
    
}