<?php

namespace App\Repositories;

use App\CPU\Images;
use App\CPU\Helpers;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
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

    public function createBrand($data)
    {
        $brand = Brand::create([
            'name' => $data->name,
            'created_by' => Auth::guard('admin')->id(),
            'slug' => $data->slug,
            'status' => $data->status,
            'is_featured' => $data->is_featured,
            'description' => $data->description,
            'meta_title' => $data->meta_title,
            'meta_keyword' => $data->meta_keyword,
            'meta_description' => $data->meta_description,
            'meta_article_tag' => $data->meta_article_tag,
            'meta_script_tag' => $data->meta_script_tag,
            'logo' => $data->logo ? Images::upload('brands', $data->logo) : null,
        ]);

        if ($data->has('listing')) {
            $json = ['status' => true, 'goto' => route('admin.brand.index'), 'message' => 'Brand created successfully'];
        } else {
            $json = ['status' => true, 'load' => true, 'message' => 'Brand created successfully'];
        }

        return response()->json($json);
    }

    public function updateBrand($id, $data)
    {
        $brand = Brand::findOrFail($id);
        $brand->name = $data->name;
        $brand->slug = $data->slug;
        $brand->status = $data->status;
        $brand->is_featured = $data->is_featured;
        $brand->description = $data->description;
        $brand->meta_title = $data->meta_title;
        $brand->meta_keyword = $data->meta_keyword;
        $brand->meta_description = $data->meta_description;
        $brand->meta_article_tag = $data->meta_article_tag;
        $brand->meta_script_tag = $data->meta_script_tag;

        if($data->logo) {
            $brand->logo = Images::upload('brands', $data->logo);
        }

        $brand->update();

        return response()->json(['status' => true, 'goto' => route('admin.brand.index'), 'message' => 'Brand updated successfully.']);
    }

    public function deleteBrand($id)
    {
        $brand = Brand::findOrFail($id);
        return $brand->delete();
    }
}