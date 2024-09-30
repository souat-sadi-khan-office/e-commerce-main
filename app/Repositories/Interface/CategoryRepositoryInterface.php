<?php

namespace App\Repositories\Interface;

interface CategoryRepositoryInterface
{
 public function index($request);
 public function store($data);
 public function categoriesDropDown();
 public function checkSlugExists(string $slug): bool;
 public function updateisFeatured($request, $id);
 public function updatestatus($request, $id);
}