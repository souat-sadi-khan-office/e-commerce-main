<?php

namespace App\Repositories;

use DataTables;
use App\CPU\Images;
use App\CPU\Helpers;
use App\Models\Product;
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

    public function dataTable()
    {
        $models = $this->getAllProducts();
        return Datatables::of($models)
            ->addIndexColumn()
            ->editColumn('product_name', function ($model) {
                return '<div class="row"><div class="col-auto">'. Images::show($model->thumb_image) .'</div><div class="col">'. $model->name .'</div></div>';
            })
            ->editColumn('info', function($model) {
                $numberOfSale = $model->details ? $model->details->number_of_sale : 0;
                $averageRating = $model->details ? ($model->details->average_rating == null ? Helpers::productAverageRating($model->id) : $model->details->average_rating) : 0;

                return '
                    <b>Number of Sale</b>: '. $numberOfSale .' <br> 
                    <b>Base Price</b>:' . format_price($model->unit_price) . '<br>
                    <b>Rating</b>: '. $averageRating;
            })
            ->editColumn('created_by', function ($model) {
                return $model->admin->name;
            })
            ->editColumn('status', function ($model) {
                $checked = $model->status == 1 ? 'checked' : '';
                return '<div class="form-check form-switch"><input data-url="' . route('admin.product.status', $model->id) . '" class="form-check-input" type="checkbox" role="switch" name="status" id="status' . $model->id . '" ' . $checked . ' data-id="' . $model->id . '"></div>';
            })
            ->editColumn('stock', function($model) {
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
    
}