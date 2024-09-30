<?php

namespace App\Repositories\Interface;

interface BrandRepositoryInterface
{
    public function getAllBrands();
    public function findBrandById($id);
    public function createBrand($data);
    public function updateBrand($id, $data);
    public function deleteBrand($id);
}
