<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Models\Brand;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Category;
use App\Models\FlashDeal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\BrandRepositoryInterface;

class HelperController extends Controller
{

    protected $brandRepository;
    protected $productRepository;
    protected $categoryRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        BrandRepositoryInterface $brandRepository
    ) {
        $this->brandRepository = $brandRepository;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function checkSlug(Request $request)
    {
        $slug = $request->get('slug');
        $id = $request->get('id');

        if (isset($id)) {
            // Using a single query with unions
            $exists = Category::where('slug', $slug)->where('id', '!=', $id)
                ->union(Product::where('slug', $slug)->where('id', '!=', $id))
                ->union(Offer::where('slug', $slug)->where('id', '!=', $id))
                ->union(Brand::where('slug', $slug)->where('id', '!=', $id))
                ->union(FlashDeal::where('slug', $slug)->where('id', '!=', $id))
                ->union(Page::where('slug', $slug)->where('id', '!=', $id))
                ->exists();
        } else {
            $exists = Category::where('slug', $slug)
                ->union(Product::where('slug', $slug))
                ->union(Offer::where('slug', $slug))
                ->union(Brand::where('slug', $slug))
                ->union(FlashDeal::where('slug', $slug))
                ->union(Page::where('slug', $slug))
                ->exists();
        }



        return response()->json(['exists' => $exists]);
    }

    public function fetcher($slug, $index = 0)
    {
        $models = ['Product', 'Category', 'Brand', 'Page', 'Offer', 'FlashDeal'];

        if ($index >= count($models)) {
            return view('errors.404');
        }

        // Get the current model name
        $model = $models[$index];
        if ($model == 'Product' && Product::where('slug', $slug)->exists()) {
            $product = $this->productDetails($slug);
            if ($product) {
                $breadcrumb = $this->getCategoryBreadcrumb($product['category']);

                $spec = $this->productRepository->specificationProduct($product['id']);
                $keySpec = $this->productRepository->specificationKeyFeaturedProduct($product['id']);

                return view('frontend.product-details', compact('product', 'breadcrumb', 'keySpec', 'spec'));
            } else {
                return $this->fetcher($slug, $index + 1);
            }

        } elseif ($model == 'Category' && Category::where('slug', $slug)->exists()) {
            $model = $this->categoryRepository->getCategoryBySlug($slug);
            if($model) {

                $categoryIdArray = $model->getParentCategoryIds();
                $categoryIdArray[] = $model->id;

                $request['category_id'] = $model->id;
            
                $products = $this->productRepository->index($request, $model->id);

                $breadcrumb = $this->getCategoryBreadcrumb($model);
                return view('frontend.listing', compact('model', 'products', 'categoryIdArray', 'breadcrumb'));
                
            } else {
                return $this->fetcher($slug, $index + 1);
            }
        } elseif ($model == 'Brand' && Brand::where('slug', $slug)->exists()) {
            $model = $this->brandRepository->getBrandBySlug($slug);
            if($model) {

                $request['brand_id'] = $model->id;
                $products = $this->productRepository->index($request);

                return view('frontend.brand-listing', compact('model', 'products'));
            } else {
                return $this->fetcher($slug, $index + 1);
            }
        } else {
            return $this->fetcher($slug, $index + 1);
        }

        // // Check for data in the current model
        // $data = $model::where('slug', $slug)->first();

        // // If no data found, recursively call fetcher with the next index
        // if (!$data) {
        //     return $this->fetcher($slug, $index + 1);
        // }

        // Return the data to the view based on the model

    }

    public function search(Request $request)
    {
        $search = $request->search;
        return view('frontend.search', compact('search'));
    }

    public function filterProduct(Request $request)
    {
        if($request->ajax()){
            $products = $this->productRepository->index($request, $request->category_id);

            return view('frontend.components.product_list',compact('products'));

        }
    }

    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->with([
            'details',
            'category:id,name,slug',
            'brand:id,name,slug',
            'ratings:id,product_id,name,review,rating', // Individual ratings
            'image' => function ($query) {
                $query->select('id', 'product_id', 'image')->where('status', 1);
            },
            'specifications' => function ($query) {
                $query->where('key_feature', 1)
                    ->with([
                        'specificationKeyType:id,name,position',
                        'specificationKeyTypeAttribute:id,name,extra'
                    ])
                    ->join('specification_key_types', 'product_specifications.type_id', '=', 'specification_key_types.id')
                    ->orderBy('specification_key_types.position', 'ASC');
            },
            'question' => function ($query) {
                $query->orderBy('id', 'desc');
            }
        ])->withCount(['ratings as averageRating' => function ($query) {
            $query->select(\DB::raw('AVG(rating)'))->groupBy('product_id'); // Calculate average rating
        }])
        ->withCount( 'ratings') // Count of ratings
        ->first([
            'id', 'category_id', 'brand_id', 'name', 'thumb_image', 'sku', 'slug', 
            'unit_price', 'is_returnable', 'return_deadline', 'is_discounted', 
            'discount', 'discount_type'
        ]);
        
  
        $discountedPrice = $product->unit_price;
        if ($product->is_discounted && $product->discount > 0) {
            $discountAmount = $product->discount_type == 'amount'
                ? $product->discount
                : ($product->unit_price * ($product->discount / 100));

            $discountedPrice -= $discountAmount;
        }
        $averageRatingPercentage = $product->averageRating !== null ? ($product->averageRating / 5) * 100 : 0;
        $productDetails = [
            'id' => $product->id,
            'category' => $product->category,
            'brand_id' => $product->brand_id,
            'brand_name' => $product->brand->name,
            'brand_slug' => $product->brand->slug,
            'name' => $product->name,
            'thumb_image' => $product->thumb_image,
            'sku' => $product->sku,
            'slug' => $product->slug,
            'description' => $product->details->description ?? '',
            'site_title' => $product->details->site_title ?? '',
            'meta_title' => $product->details->meta_title ?? '',
            'meta_keyword' => $product->details->meta_keyword ?? '',
            'meta_description' => $product->details->meta_description ?? '',
            'meta_article_tags' => $product->details->meta_article_tags ?? '',
            'meta_script_tags' => $product->details->meta_script_tags ?? '',
            'video_link' => $product->details->video_link ?? '',
            'price' => $product->unit_price,
            'return_deadline' => $product->is_returnable ? $product->return_deadline : 0,
            'ratings_count' => $product->ratings_count,
            'average_rating' => number_format($product->averageRating, 2),
            'average_rating_percantage' => $averageRatingPercentage,
            'discount' => $product->is_discounted ? $product->discount : 0,
            'discount_type' => $product->discount_type,
            'discounted_price' => $discountedPrice,
            'current_stock' => $product->details->current_stock ?? 0,
            'is_low_stock' => isset($product->details) && $product->details->current_stock <= $product->details->low_stock_quantity,
            'is_COD_available' => $product->details->cash_on_delivery ?? false,
            'total_sold' => $product->details->number_of_sale ?? 0,
            'question'=>$product->question,
            'ratings' => $product->ratings,
            'images' => $product->image,
            'key_features' => []
        ];

        if ($product->specifications->isNotEmpty()) {
            foreach ($product->specifications as $specification) {
                $productDetails['key_features'][] = [
                    'type_id' => $specification->specificationKeyType->id ?? null,
                    'type_name' => $specification->specificationKeyType->name ?? '',
                    'attribute_id' => $specification->specificationKeyTypeAttribute->id ?? null,
                    'attribute_name' => ($specification->specificationKeyTypeAttribute->name ?? '') . ' ' . ($specification->specificationKeyTypeAttribute->extra ?? ''),
                ];
            }
        }
        return $productDetails;
    }

    public function getCategoryBreadcrumb($category)
    {
        $breadcrumb = [];
        while ($category) {
            $breadcrumb[] = $category;
            $category = $category->parent;
        }

        return array_reverse($breadcrumb);
    }


    public function cacheClear()
    {
        Artisan::call('optimize:clear');

        return response()->json(['status' => true, 'message' => 'Optimized', 'load' => true]);
    }
}
