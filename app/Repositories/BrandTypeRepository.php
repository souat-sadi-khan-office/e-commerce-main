<?php

namespace App\Repositories;

use App\Models\BrandType;
use App\Repositories\Interface\BrandTypeRepositoryInterface;

class BrandTypeRepository implements BrandTypeRepositoryInterface
{
    public function getAllBrandTypes()
    {
        return BrandType::all();
    }

    public function findBrandTypeById($id)
    {
        return BrandType::findOrFail($id);
    }

    public function createBrandType($data)
    {
        BrandType::create([
            'name'                  => $data->name,
            'status'                => $data->status,
            'brand_id'              => $data->brand_id,
            'is_featured'           => $data->is_featured,
            'related_categories'    => $data->related_categories
        ]);

        return response()->json(['status' => true, 'load' => true, 'message' => 'Brand type created successfully']);
    }

    public function updateBrandType($id, $data)
    {
        $brandType = BrandType::findOrFail($id);

        $brandType->name                = $data->name;
        $brandType->status              = $data->status;
        $brandType->brand_id            = $data->brand_id;
        $brandType->is_featured         = $data->is_featured;
        $brandType->related_categories  = $data->related_categories;

        $brandType->update();

        return response()->json(['status' => true, 'load' => true, 'message' => 'Brand type updated successfully.']);
    }

    public function deleteBrandType($id)
    {
        $brandType = BrandType::findOrFail($id);
        return $brandType->delete();
    }
}