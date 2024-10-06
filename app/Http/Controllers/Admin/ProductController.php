<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Images;
use App\CPU\Helpers;
use App\Models\Product;
use App\Models\ProductTax;
use App\Models\ProductImage;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Models\StockPurchase;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProductSpecification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interface\TaxRepositoryInterface;
use App\Repositories\Interface\CityRepositoryInterface;
use App\Repositories\Interface\ZoneRepositoryInterface;
use App\Repositories\Interface\CountryRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\CurrencyRepositoryInterface;
use App\Repositories\Interface\ProductSpecificationRepositoryInterface;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;
    protected $specificationRepository;
    private $taxRepository;
    private $currencyRepository;
    private $zoneRepository;
    private $countryRepository;
    private $cityRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        ProductRepositoryInterface $productRepository,
        TaxRepositoryInterface $taxRepository,
        ProductSpecificationRepositoryInterface $specificationRepository,
        CurrencyRepositoryInterface $currencyRepository,
        ZoneRepositoryInterface $zoneRepository,
        CountryRepositoryInterface $countryRepository,
        CityRepositoryInterface $cityRepository,
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->specificationRepository = $specificationRepository;
        $this->taxRepository = $taxRepository;
        $this->currencyRepository = $currencyRepository;
        $this->zoneRepository = $zoneRepository;
        $this->countryRepository = $countryRepository;
        $this->cityRepository = $cityRepository;
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
        $currencies = $this->currencyRepository->getAllActiveCurrencies();
        $zones = $this->zoneRepository->getAllActiveZones();
        $countries = $this->countryRepository->getAllActiveCountry();
        $cities = $this->cityRepository->getAllActiveCity();
        return view('backend.product.create', compact('taxes', 'currencies', 'zones', 'countries', 'cities'));
    }

    public function destroy($id)
    {
        $this->productRepository->deleteProduct($id);

        return response()->json([
            'status' => true,
            'load' => true,
            'message' => "Product deleted successfully"
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
            'stock_types' => 'required',
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
        $product->stock_types = $request->stock_types;
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

            // If any taxes array exist
            $taxArray = $request->taxes;
            if(count($taxArray) > 0) {
                $taxIdArray = $request->tax_id;
                $taxTypeArray = $request->tax_types;

                for($taxCounter = 0; $taxCounter < count($taxArray); $taxCounter++) {
                    $tax = new ProductTax;
                    $tax->product_id = $product->id;
                    $tax->tax_id = $taxIdArray[$taxCounter];
                    $tax->tax = $taxArray[$taxCounter];
                    $tax->tax_type = $taxTypeArray[$taxCounter] == 'flat' ? 'amount' : 'percent';
                    $tax->save();
                }
            }

            // Stock Purchase
            $stockPurchase = new StockPurchase;
            $stockPurchase->product_id = $product->id;
            $stockPurchase->admin_id = $product->admin_id;
            $stockPurchase->currency_id = $product->currency_id;
            $stockPurchase->sku = $request->sku;
            $stockPurchase->quantity = $request->quantity;
            $stockPurchase->purchase_unit_price = ($request->quantity * $request->purchase_unit_price);
            if(isset($request->file)) {
                $stockPurchase->file = Images::upload('products.files',$request->file);
            }
            $stockPurchase->is_sellable = $request->is_sellable;
            $stockPurchase->save();
            if($stockPurchase) {

                // update product in_stock column
                $product->in_stock = 1;
                $product->save();

                // Add stock data into product_stock table by stock_types
                switch($request->stock_types) {
                    case 'globally':
                        $stock = new ProductStock;
                        $stock->product_id = $product->id;
                        $stock->stock_purchase_id  = $stockPurchase->id;
                        $stock->in_stock = 1;
                        $stock->number_of_sale = 0;
                        $stock->stock = $request->globally_stock_amount;
                        $stock->save();
                    break;
                    case 'zone_wise':

                        $zoneIdArray = $request->zone_id;
                        $zoneWiseStockQuantityArray = $request->zone_wise_stock_quantity;

                        if(count($zoneIdArray) > 0) {
                            for($zoneCounter = 0; $zoneCounter < count($zoneIdArray); $zoneCounter++) {
                                $stock = new ProductStock;
                                $stock->product_id = $product->id;
                                $stock->stock_purchase_id  = $stockPurchase->id;
                                $stock->zone_id  = $zoneIdArray[$zoneCounter];
                                $stock->in_stock = 1;
                                $stock->number_of_sale = 0;
                                $stock->stock = $zoneWiseStockQuantityArray[$zoneCounter];
                                $stock->save();
                            }
                        }

                    break;
                    case 'country_wise':
                        $countryIdArray = $request->country_id;
                        $countryWiseStockQuantityArray = $request->country_wise_quantity;

                        if(count($countryIdArray) > 0) {
                            for($countryCounter = 0; $countryCounter < count($countryIdArray); $countryCounter++) {
                                $stock = new ProductStock;
                                $stock->product_id = $product->id;
                                $stock->stock_purchase_id  = $stockPurchase->id;
                                $stock->country_id  = $countryIdArray[$countryCounter];
                                $stock->in_stock = 1;
                                $stock->number_of_sale = 0;
                                $stock->stock = $countryWiseStockQuantityArray[$countryCounter];
                                $stock->save();
                            }
                        }
                    break;
                    case 'city_wise':

                        $cityIdArray = $request->city_id;
                        $cityWiseStockQuantityArray = $request->city_wise_quantity;

                        if(count($cityIdArray) > 0) {
                            for($cityCounter = 0; $cityCounter < count($cityIdArray); $cityCounter++) {
                                $stock = new ProductStock;
                                $stock->product_id = $product->id;
                                $stock->stock_purchase_id  = $stockPurchase->id;
                                $stock->city_id  = $cityIdArray[$cityCounter];
                                $stock->in_stock = 1;
                                $stock->number_of_sale = 0;
                                $stock->stock = $cityWiseStockQuantityArray[$cityCounter];
                                $stock->save();
                            }
                        }

                    break;
                }
            }

            // update current_stock data on product_details table
            $details->current_stock = $request->quantity;
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
        return $this->productRepository->store($request);
    }

    public function edit($id)
    {
        $model = $this->productRepository->getProductById($id);

        $taxes = $this->taxRepository->getAllActiveTaxes();
        $currencies = $this->currencyRepository->getAllActiveCurrencies();
        $zones = $this->zoneRepository->getAllActiveZones();
        $countries = $this->countryRepository->getAllActiveCountry();
        $cities = $this->cityRepository->getAllActiveCity();
        return view('backend.product.edit', compact('model', 'taxes', 'currencies', 'zones', 'countries', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'slug')->ignore($id),
            ],            
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
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
            'is_discounted' => 'required|boolean',
            'status' => 'required|boolean',
            'is_featured' => 'required|boolean',
            'is_returnable' => 'required|boolean',
            'low_stock_quantity' => 'required|integer|min:0',
            'cash_on_delivery' => 'required|boolean',
            'est_shipping_time' => 'nullable|string|max:255',
            'taxes' => 'required|array',
            'tax_types' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->category_id = $request->category_id[count($request->category_id)-1];
        $product->brand_id = $request->brand_id;
        $product->brand_type_id = $request->brand_type_id;
        $product->is_discounted = $request->is_discounted;
        $product->discount_type = $request->discount_type;
        $product->discount = $request->discount;
        $product->discount_start_date = $request->discount_start_date == null ? null : date('Y-m-d', strtotime($request->discount_start_date));
        $product->discount_end_date = $request->discount_end_date == null ? null : date('Y-m-d', strtotime($request->discount_end_date));
        $product->status = $request->status;
        $product->is_featured = $request->is_featured;
        $product->is_returnable = $request->is_returnable;
        $product->return_deadline = $request->return_deadline;

        if($request->thumb_image) {
            $product->thumb_image = Images::upload('products', $request->thumb_image);
        }

        $product->save();

        // if the product is saved
        if($product) {

            // saved the product details
            $details = ProductDetail::where('product_id', $product->id)->first();
            if($details) {
                $details->video_provider = $request->video_provider;
                $details->video_link = $request->video_link;
                $details->description = $request->description;
                $details->site_title = $request->site_title;
                $details->meta_title = $request->meta_title;
                $details->meta_keyword = $request->meta_keyword;
                $details->meta_description = $request->meta_description;
                $details->meta_article_tags = $request->meta_article_tags;
                $details->meta_script_tags = $request->meta_script_tags;
                $details->low_stock_quantity = $request->low_stock_quantity;
                $details->cash_on_delivery = $request->cash_on_delivery;
                $details->est_shipping_days = $request->est_shipping_time;
                $details->save();
            }

            // update the tax details
            if(count($request->tax_id) > 0) {
                $taxIdArray = $request->tax_id;
                $taxAmountArray = $request->taxes;
                $taxTypeArray = $request->tax_types;

                for($taxCounter = 0; $taxCounter < count($taxIdArray); $taxCounter++) {
                    $taxModel = ProductTax::find($taxIdArray[$taxCounter]);
                    $taxModel->tax = $taxAmountArray[$taxCounter];
                    $taxModel->tax_type = $taxTypeArray[$taxCounter];
                    $taxModel->save();
                }
            }

            // images
            if(isset($request->images)) {
                $this->removeImage($product->id);

                foreach($request->images as $image) {
                    $product_image= new ProductImage();
                    $product_image->product_id = $product->id;
                    $product_image->image = Images::upload('products',$image);
                    $product_image->status = 1;
                    $product_image->save();
                }  
            }
        }

        return response()->json(['status' => true, 'message' => 'Product updated successfully.', 'goto' => route('admin.product.index')]);
    }

    private function removeImage($productId) 
    {
        return ProductImage::where('product_id', $productId)->delete();
    }
}
