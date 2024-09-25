<?php

namespace App\Repositories;

use App\Repositories\Interface\OrderRepositoryInterface;


class OrderRepository implements OrderRepositoryInterface
{
    public function index($request)
    {
        return 1;
    }
    
}