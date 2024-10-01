<?php

namespace App\Repositories\Interface;

interface BrandTypeRepositoryInterface
{
    public function getAllBrandTypes();
    public function findBrandTypeById($id);
    public function createBrandType($data);
    public function updateBrandType($id, $data);
    public function deleteBrandType($id);
}
