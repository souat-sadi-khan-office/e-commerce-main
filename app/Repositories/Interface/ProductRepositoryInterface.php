<?php

namespace App\Repositories\Interface;

interface ProductRepositoryInterface
{
    public function index($request);
    public function dataTable();
    public function updateStatus($request, $id);
    public function updateFeatured($request, $id);
}