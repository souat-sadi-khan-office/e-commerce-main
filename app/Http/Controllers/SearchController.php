<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\BannerController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Interface\BannerRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\Interface\BrandTypeRepositoryInterface;
use App\Repositories\Interface\BrandRepositoryInterface;

class SearchController extends Controller
{
    private $brandTypeRepository;
    private $brandRepository;
    private $bannerRepository;

    public function __construct(
        BrandTypeRepositoryInterface $brandTypeRepository,
        BrandRepositoryInterface $brandRepository,
        BannerRepositoryInterface $bannerRepository
    ) {
        $this->brandTypeRepository = $brandTypeRepository;
        $this->brandRepository = $brandRepository;
        $this->bannerRepository = $bannerRepository;
    }

    // for searching by types using brand_id
    public function searchForBrandTypes(Request $request) 
    {
        $brandId = $request->brand_id;

        $brand = $this->brandRepository->findBrandById($brandId);
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

    // searching for category by id
    public function searchByCategoryId(Request $request)
    {
        $category_id = $request->category_id;

        if(!$category_id) {
            return [
                'status' => false,
                'message' => 'Category not found'
            ];
        }

        $category = Category::find($category_id);

        return [
            'status' => true,
            'id' => $category->id, 
            'text' => $category->name,
            'thumb_image' => asset($category->photo)
        ];
    }

    // searching for brand by id
    public function searchByBrandId(Request $request)
    {
        $brand_id = $request->brand_id;

        if(!$brand_id) {
            return [
                'status' => false,
                'message' => 'Brand not found'
            ];
        }

        $brand = Brand::find($brand_id);

        return [
            'status' => true,
            'id' => $brand->id, 
            'text' => $brand->name,
            'thumb_image' => asset($brand->logo)
        ];
    }
    
    // for searching categories
    public function searchByCategory(Request $request) 
    {
        if(!isset($request->searchTerm)){ 
            $categories = Category::where('parent_id', null)->get();

            $json = $categories->map(function($category) {
                return [
                    'id' => $category->id, 
                    'text' => $category->name,
                    'image_url' => asset($category->photo)
                ];
            });
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

    // for product stock
    public function searchForProductStock(Request $request) 
    {
        $productId = $request->product_id;
    
        if($productId != null) {
            $model = Product::with('details')->find($productId);

            if($model) {
                return response()->json($model);
            }
        } else {
            return response()->json();
        }
    }

// For Brand Source Id
    public function getSourceOptions($source)
{
    $data = $this->bannerRepository->getSourceOptions($source);

    return response()->json(['source' => $data]);
}

}
