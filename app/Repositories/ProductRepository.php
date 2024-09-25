<?php

namespace App\Repositories;

use App\Repositories\Interface\ProductRepositoryInterface;


class ProductRepository implements ProductRepositoryInterface
{
    public function index($request)
    {
        return 1;
    }
    
}