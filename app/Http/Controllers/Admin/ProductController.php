<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Images;
use App\CPU\Helpers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use App\Models\ProductSpecification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interface\TaxRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\ProductSpecificationRepositoryInterface;

class ProductController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;
    protected $specificationRepository;
    private $taxRepository;


    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        ProductRepositoryInterface $productRepository,
        TaxRepositoryInterface $taxRepository,
        ProductSpecificationRepositoryInterface $specificationRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->specificationRepository = $specificationRepository;
        $this->taxRepository = $taxRepository;
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->productRepository->dataTable();
        }

        return view('backend.product.index');
    }

    public function create(Request $request)
    {
        if (isset($request->parent_id)) {

            return response()->json(['subs' => $this->categoryRepository->categoriesDropDown($request)]);
        }
        $taxes = $this->taxRepository->getAllActiveTaxes();

        return view('backend.product.create', compact('taxes'));
    }

    public function destroy($id)
    {
        $this->productRepository->deleteProduct($id);

        return response()->json([
            'status' => true,
            'load' => true,
            'message' => "Brand deleted successfully"
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        return $this->productRepository->updateStatus($request, $id);
    }

    public function updateFeatured(Request $request, $id)
    {
        return $this->productRepository->updateFeatured($request, $id);
    }
    public function specification(Request $request)
    {
        if (isset($request->category_id)) {

            return response()->json(['keys' => $this->specificationRepository->keys($request->category_id)]);
        } elseif ($request->key_id) {
            return response()->json(['types' => $this->specificationRepository->types($request->key_id)]);
        } elseif ($request->type_id) {
            return response()->json(['attributes' => $this->specificationRepository->attributes($request->type_id)]);
        }
        return false;
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // dd($request->specification_key);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug', // Assuming 'products' is your table name
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id', // Assuming you have a categories table
            'unit' => 'nullable|string|max:50',
            'min_purchase_quantity' => 'required|integer|min:1',
            'images' => 'required|array',
            'video_provider' => 'nullable|string|max:255',
            'video_link' => 'nullable|url',
            'description' => 'nullable|string',
            'site_title' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_article_tags' => 'nullable|string|max:255',
            'meta_script_tags' => 'nullable|string|max:255',
            'specification_key' => 'nullable|array', // Changed to nullable
            'specification_key.*.key_id' => 'required_with:specification_key', // Only required if specification_key is present
            'specification_key.*.type_id' => 'required_with:specification_key|array',
            'is_discounted' => 'required|boolean',
            'status' => 'required|boolean',
            'is_featured' => 'required|boolean',
            'is_returnable' => 'required|boolean',
            'low_stock_quantity' => 'required|integer|min:0',
            'cash_on_delivery' => 'required|boolean',
            'est_shipping_time' => 'nullable|string|max:255',
            'taxes' => 'required|array',
            'taxes.*' => 'numeric|min:0',
            'tax_types' => 'required|array',
            'tax_types.*' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        DB::beginTransaction();
        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->category_id = $request->category_id[count($request->category_id)-1];
        $product->admin_id = Auth::guard('admin')->id();
        $product->brand_id = $request->brand_id;
        $product->brand_type_id = $request->brand_type_id;
        $product->thumb_image = Images::upload('products', $request->thumb_image);
        $product->unit_price = isset($request->unit_price) ? $request->unit_price : 0;
        $product->status = $request->status;
        $product->in_stock = isset($request->in_stock) ? $request->in_stock : 0;
        $product->is_featured = $request->is_featured;
        $product->low_stock = isset($request->low_stock) ? $request->low_stock : 0;
        $product->is_discounted = $request->is_discounted;
        $product->discount = $request->discount;
        $product->discount_start_date = $request->discount_start_date;
        $product->discount_end_date = $request->discount_end_date;
        $product->is_returnable = $request->is_returnable;
        $product->return_deadline = $request->return_deadline;
        $product->save();

        if ($product) {
            $details = new ProductDetail();
            $details->product_id = $product->id;
            $details->video_provider = $request->video_provider;
            $details->video_link = $request->video_link;
            $details->description = $request->description;
            $details->current_stock = 0;
            $details->low_stock_quantity = $request->low_stock_quantity;
            $details->cash_on_delivery = $request->cash_on_delivery;
            $details->est_shipping_days = $request->est_shipping_time;
            $details->site_title = $request->site_title;
            $details->meta_title = $request->meta_title;
            $details->meta_keyword = $request->meta_keyword;
            $details->meta_description = $request->meta_description;
            $details->meta_article_tags = $request->meta_article_tags;
            $details->meta_script_tags = $request->meta_script_tags;
            $details->save();


            if(isset($request->images)){
                foreach($request->images as $image){
                    $product_image= new ProductImage();
                    $product_image->product_id = $product->id;
                    $product_image->image = Images::upload('products',$image);
                    $product_image->status = 1;
                    $product_image->save();
                }  
            }


            // $tax will be Added Later Product_Taxes

            if(isset($request->specification_key)){

                foreach ($request->specification_key as $specification) {
                    $keyId = $specification['key_id'];
                    $processedTypeIds = []; // Track unique type_ids
                
                    // Loop through type_id
                    foreach ($specification['type_id'] as $typeId => $value) {

                        if(is_numeric($typeId)){
                            $tkey=$value;
                        }
                        // Skip non-numeric keys
                        if (!is_numeric($typeId)) {
                            continue; // Skip features and attributes keys
                        }
                
                        // Skip if this type_id has already been processed
                        if (in_array($typeId, $processedTypeIds)) {
                            continue;
                        }
                
                        // Initialize variables
                        $firstAttributeId = null;
                        $featuresExist = false;
                // dd($specification['type_id'],[$value],$typeId,$specification['type_id']['attribute_id'][$value][0],$specification['type_id']['features'][$value],$tkey);
                        // Check for attributes
                        if (isset($specification['type_id']['attribute_id'][$value]) 
                            && is_array($specification['type_id']['attribute_id'][$value]) 
                            && !empty($specification['type_id']['attribute_id'][$value])) {
                            
                            // Get the first attribute ID
                            $firstAttributeId = $specification['type_id']['attribute_id'][$value][0]; // First attribute
                        }
                
                        // Check for features
                        if (isset($specification['type_id']['features'][$value])) {
                            $featuresExist = true; // Set to true if features exist
                        }
                
                        // Create a ProductSpecification entry only if we have an attribute ID
                        if ($firstAttributeId !== null) {
                            $productSpecification = new ProductSpecification();
                            $productSpecification->product_id = $product->id; // Ensure this is included in the request
                            $productSpecification->key_id = $keyId;
                            $productSpecification->type_id = intval($tkey);
                            $productSpecification->attribute_id = intval($firstAttributeId); // Store the first attribute ID
                            
                            // Set key_feature as boolean
                            $productSpecification->key_feature = $featuresExist ? 1 : 0; // Use ternary for clarity
                
                            $productSpecification->save(); // Save the entry
                        }
                
                        // Mark this type_id as processed
                        $processedTypeIds[] = $typeId;
                    }
                }
                
                
        }

            DB::commit();

            dd('done!');
        }else{
            DB::rollBack();
        }
    }
}
