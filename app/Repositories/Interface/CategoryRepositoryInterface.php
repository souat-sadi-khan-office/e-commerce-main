<?php

namespace App\Repositories\Interface;

interface CategoryRepositoryInterface
{
 public function index($request);
 public function store($data);
 public function checkSlugExists(string $slug): bool;
}