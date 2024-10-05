<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
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
    // for searching product
    public function searchByProduct(Request $request) 
    {
        $json = [];
        if(!isset($request->searchTerm)){ 
            $products = Product::select('id', 'name', 'thumb_image')->where('status', 1)->take(10)->get();

            foreach($products as $product) {
                $json[] = [
                    'id' => $product->id,
                    'text' => $product->name ,
                    'image_url' => asset($product->thumb_image)
                ];
            }
        } else {
            $search = $request->searchTerm;

            $products = Product::select('id', 'name', 'thumb_image')->where('name', $search)->where('status', 1)->get();

            $json = [];
            foreach($products as $brand) {
                $json[] = [
                    'id' => $brand->id, 
                    'text' => $brand->name,
                    'image_url' => asset($brand->thumb_image)
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

            $json = $categories->map(function($category) {
                return [
                    'id' => $category->id, 
                    'text' => $category->name,
                    'image_url' => asset($category->photo)

                ];
            });        
    
        }
        
        return response()->json($json);
    }

    // for product data
    public function searchForProductDetails(Request $request) 
    {
        $productIds = $request->data;
    
        if($productIds != null) {
            $products = Product::select('id', 'name', 'thumb_image', 'unit_price')->whereIn('id', $productIds)->get();

            if($products) {
                return $products->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'thumb_image' => url($product->thumb_image),
                        'unit_price' => $product->unit_price
                    ];
                });
            }
        } else {
            return response()->json();
        }
    }
}
