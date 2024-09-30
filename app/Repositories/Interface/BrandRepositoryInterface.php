<?php

namespace App\Repositories\Interface;

interface BrandRepositoryInterface
{
    public function getAllBrands();
    public function findBrandById($id);
    public function createBrand(array $data);
    public function updateBrand($id, array $data);
    public function deleteBrand($id);
}
