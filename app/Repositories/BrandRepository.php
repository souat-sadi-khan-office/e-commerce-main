<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\Interface\BrandRepositoryInterface;

class BrandRepository implements BrandRepositoryInterface
{
    public function getAllBrands()
    {
        return Brand::all();
    }

    public function findBrandById($id)
    {
        return Brand::findOrFail($id);
    }

    public function createBrand(array $data)
    {
        $brand = Brand::create($data);

        return $brand;
    }

    public function updateBrand($id, array $data)
    {
        $brand = Brand::findOrFail($id);
        $brand->update($data);

        return $brand;
    }

    public function deleteBrand($id)
    {
        $brand = Brand::findOrFail($id);
        return $brand->delete();
    }
}