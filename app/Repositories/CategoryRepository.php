<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interface\CategoryRepositoryInterface;


class CategoryRepository implements CategoryRepositoryInterface
{
    public function index($request)
    {
        return 1;
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function checkSlugExists(string $slug): bool
    {
        return Category::where('slug', $slug)->exists();
    }
    
}