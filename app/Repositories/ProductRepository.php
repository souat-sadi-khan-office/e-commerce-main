<?php

namespace App\Repositories;

use DataTables;
use App\CPU\Images;
use App\CPU\Helpers;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\DB;
use App\Models\ProductSpecification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interface\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function index($request)
    {
        return 1;
    }

    public function getAllProducts()
    {
        return Product::orderBy('id', 'DESC')->get();
    }

    public function getProductById($id)
    {
        return Product::findOrFail($id);
    }

    public function dataTable()
    {
        $models = $this->getAllProducts();
        return Datatables::of($models)
            ->addIndexColumn()
            ->editColumn('product_name', function ($model) {
                return '<div class="row"><div class="col-auto">' . Images::show($model->thumb_image) . '</div><div class="col">' . $model->name . '</div></div>';
            })
            ->editColumn('info', function ($model) {
                $numberOfSale = $model->details ? $model->details->number_of_sale : 0;
                $averageRating = $model->details ? ($model->details->average_rating == null ? Helpers::productAverageRating($model->id) : $model->details->average_rating) : 0;

                return '
                    <b>Number of Sale</b>: ' . $numberOfSale . ' <br> 
                    <b>Base Price</b>:' . format_price($model->unit_price) . '<br>
                    <b>Rating</b>: ' . $averageRating;
            })
            ->editColumn('created_by', function ($model) {
                return $model->admin->name;
            })
            ->editColumn('status', function ($model) {
                $checked = $model->status == 1 ? 'checked' : '';
                return '<div class="form-check form-switch"><input data-url="' . route('admin.product.status', $model->id) . '" class="form-check-input" type="checkbox" role="switch" name="status" id="status' . $model->id . '" ' . $checked . ' data-id="' . $model->id . '"></div>';
            })
            ->editColumn('stock', function ($model) {
                return $model->details ? $model->details->current_stock : 0;
            })
            ->editColumn('featured', function ($model) {
                $is_featured = $model->is_featured == 1 ? 'checked' : '';
                return '<div class="form-check form-switch"><input data-url="' . route('admin.product.featured', $model->id) . '" class="form-check-input" type="checkbox" role="switch" name="status" id="status' . $model->id . '" ' . $is_featured . ' data-id="' . $model->id . '"></div>';
            })
            ->addColumn('action', function ($model) {
                return view('backend.product.action', compact('model'));
            })
            ->rawColumns(['action', 'status', 'created_by', 'featured', 'info', 'stock', 'product_name'])
            ->make(true);
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }

    public function updateStatus($request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.'], 404);
        }

        $product->status = $request->input('status');
        $product->save();

        return response()->json(['success' => true, 'message' => 'Product status updated successfully.']);
    }

    public function updateFeatured($request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.'], 404);
        }

        $product->is_featured = $request->input('status');
        $product->save();

        return response()->json(['success' => true, 'message' => 'Product featured status updated successfully.']);
    }


    public function store($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
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
            'specification_key' => 'nullable|array',
            'specification_key.*.key_id' => 'required_with:specification_key',
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
        $product->category_id = $request->category_id[count($request->category_id) - 1];
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


            if (isset($request->images)) {
                foreach ($request->images as $image) {
                    $product_image = new ProductImage();
                    $product_image->product_id = $product->id;
                    $product_image->image = Images::upload('products', $image);
                    $product_image->status = 1;
                    $product_image->save();
                }
            }


            // $tax will be Added Later Product_Taxes

            if (isset($request->specification_key)) {

                foreach ($request->specification_key as $specification) {
                    $keyId = $specification['key_id'];
                    $processedTypeIds = []; // Track unique type_ids

                    // Loop through type_id
                    foreach ($specification['type_id'] as $typeId => $value) {

                        if (is_numeric($typeId)) {
                            $tkey = $value;
                        }
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

                        // Check for attributes
                        if (
                            isset($specification['type_id']['attribute_id'][$value])
                            && is_array($specification['type_id']['attribute_id'][$value])
                            && !empty($specification['type_id']['attribute_id'][$value])
                        ) {

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
                            $productSpecification->product_id = $product->id;
                            $productSpecification->key_id = $keyId;
                            $productSpecification->type_id = intval($tkey);
                            $productSpecification->attribute_id = intval($firstAttributeId);

                            $productSpecification->key_feature = $featuresExist ? 1 : 0;

                            $productSpecification->save();
                        }

                        // Mark this type_id as processed
                        $processedTypeIds[] = $typeId;
                    }
                }
            }

            DB::commit();
            return response()->json(['status' => true, 'load' => true, 'message' => 'Product Created successfully.']);
        } else {
            DB::rollBack();
        }
    }

    public function specificationproducts()
    {
        $data = Product::withCount('specifications')
        ->with('admin:id,name')
        ->orderBy('specifications_count', 'desc')
        ->get();
        return $data->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'thumb_image' => $item->thumb_image,
                'specifications_count' => $item->specifications_count,
                'status' => $item->status,
                'is_featured' => $item->is_featured,
                'created_by' => $item->admin ? $item->admin->name : null,
            ];
        });
    }

    public function specificationproductsDatatable()
    {
        $models = $this->specificationproducts();
        return Datatables::of($models)
            ->addIndexColumn()
            ->editColumn('name', function ($model) {
                return '<div class="row"><div class="col-auto">' . Images::show($model['thumb_image']) . '</div><div class="col">' . $model['name'] . '</div></div>';
            })
            ->editColumn('created_by', function ($model) {
                return $model['created_by'];
            })
            ->editColumn('status', function ($model) {
                $checked = $model['status'] == 1 ? 'checked' : '';
                return '<div class="form-check form-switch"><input data-url="' . route('admin.product.status', $model['id']) . '" class="form-check-input" type="checkbox" role="switch" name="status" id="status' . $model['id'] . '" ' . $checked . ' data-id="' . $model['id'] . '"></div>';
            })
            ->editColumn('is_featured', function ($model) {
                $is_featured = $model['is_featured'] == 1 ? 'checked' : '';
                return '<div class="form-check form-switch"><input data-url="' . route('admin.product.featured', $model['id']) . '" class="form-check-input" type="checkbox" role="switch" name="status" id="status' . $model['id'] . '" ' . $is_featured . ' data-id="' . $model['id'] . '"></div>';
            })
            ->editColumn('specifications_count', function ($model) {
                return "<div class='w-100 text-center'>
                            <span class='badge bg-dark rounded-pill' style='padding: 10px 20px;'>
                                " . $model['specifications_count'] . "
                            </span>
                        </div>";
            })
            ->addColumn('action', function ($model) {
                return view('backend.product.specification.action', compact('model'));
            })
            ->rawColumns(['action', 'status', 'created_by', 'is_featured', 'name', 'specifications_count'])
            ->make(true);
    }

    public function specificationproductModal($id)
    {
        $data = ProductSpecification::where('product_id', $id)->with('product:id,category_id,name', 'specificationKey', 'specificationKeyType', 'specificationKeyTypeAttribute')->get();
        if ($data->isEmpty()) {
            $product = Product::find($id);
            $product_name = isset($product) ? $product->name : null;
            $category_id = isset($product) ? $product->category_id : null;
        } else {

            $product_name = isset($data) ? $data[0]->product->name : null;
            $category_id = isset($data) ? $data[0]->product->category_id : null;
        }
        $product_id = $id;


        $mapped = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'key_id' => $item->key_id ?? null,
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'specificationKey' => $item->specificationKey ? $item->specificationKey->name : null,
                'specificationKeyType' => $item->specificationKeyType ? $item->specificationKeyType->name : null,
                'specificationKeyTypeAttribute' => $item->specificationKeyTypeAttribute ? $item->specificationKeyTypeAttribute->name . ' ' . $item->specificationKeyTypeAttribute->extra : null,
                'key_feature' => $item->key_feature,
            ];
        });
        $models = $mapped->groupBy('key_id');

        return view('backend.product.specification.modal', compact('models', 'product_name', 'category_id','product_id'));
    }


    public function specificationsAdd($request,$id){

        if (isset($request->specification_key)) {

            foreach ($request->specification_key as $specification) {
                $keyId = $specification['key_id'];
                $processedTypeIds = []; // Track unique type_ids

                // Loop through type_id
                foreach ($specification['type_id'] as $typeId => $value) {

                    if (is_numeric($typeId)) {
                        $tkey = $value;
                    }
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

                    // Check for attributes
                    if (
                        isset($specification['type_id']['attribute_id'][$value])
                        && is_array($specification['type_id']['attribute_id'][$value])
                        && !empty($specification['type_id']['attribute_id'][$value])
                    ) {

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
                        $productSpecification->product_id = $id;
                        $productSpecification->key_id = $keyId;
                        $productSpecification->type_id = intval($tkey);
                        $productSpecification->attribute_id = intval($firstAttributeId);

                        $productSpecification->key_feature = $featuresExist ? 1 : 0;

                        $productSpecification->save();
                    }

                    // Mark this type_id as processed
                    $processedTypeIds[] = $typeId;
                }
            }
            return response()->json(['status' => true, 'load' => true, 'message' => 'Product Specifications Created successfully.']);

        }
        return response()->json(['status' => false, 'message' => 'No Specificatiions Posted.']);
    }

    public function delete($id)
    {
        $specification = ProductSpecification::findOrFail($id);
        $specification->delete();
        return response()->json(['status' => true, 'message' => 'Product Specification Deleted successfully.']);
    }

    public function keyfeature($id)
    {

        $specification = ProductSpecification::find($id);

        if (!$specification) {
            return response()->json(['success' => false, 'message' => 'Product Specification not found.'], 404);
        }

        $specification->key_feature = !$specification->key_feature;
        $specification->save();

        return response()->json(['success' => true, 'message' => 'Product Specification featured status updated successfully.']);
    }
}
