<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\Interface\BrandTypeRepositoryInterface;

class SearchController extends Controller
{
    private $brandTypeRepository;

    public function __construct(BrandTypeRepositoryInterface $brandTypeRepository)
    {
        $this->brandTypeRepository = $brandTypeRepository;
    }

    // for searching by types using brand_id
    public function searchForBrandTypes(Request $request) 
    {
        $brandId = $request->brand_id;

        $brand = $this->brandTypeRepository->findBrandTypeById($brandId);
        if(!$brand) {
            return response()->json([
                'status' => false,
                'message' => 'Brand not found'
            ]);
        }

        $brandTypes = $this->brandTypeRepository->getAllBrandTypesByBrandId($brandId);

        return response()->json([
            'status' => true,
            'responses' => $brandTypes
        ]);
    }

    // for searching categories
    public function searchByBrands(Request $request) 
    {
        $json = [];
        if(!isset($request->searchTerm)){ 
            $brands = Brand::select('id', 'name', 'logo')->where('status', 1)->get();

            foreach($brands as $brand) {
                $json[] = [
                    'id' => $brand->id,
                    'text' => $brand->name ,
                    'image_url' => asset($brand->logo)
                ];
            }
        } else {
            $search = $request->searchTerm;

            $brands = Brand::select('id', 'name', 'logo')->where('name', $search)->where('status', 1)->get();

            $json = [];
            foreach($brands as $brand) {
                $json[] = [
                    'id' => $brand->id, 
                    'text' => $brand->name,
                    'image_url' => asset($brand->logo)
                ];
            }
    
        }
        
        return response()->json($json);
    }
    
    // for searching categories
    public function searchByCategory(Request $request) 
    {
        if(!isset($request->searchTerm)){ 
            $json = [];
        } else {
            $search = $request->searchTerm;

            $categories = Category::where('name','like', "%$search%")->get();

            $json = [];
            foreach($categories as $category) {
                $json[] = [
                    'id' => $category->id, 
                    'text' => $category->name 
                ];
            }
    
        }
        
        return response()->json($json);
    }
}
