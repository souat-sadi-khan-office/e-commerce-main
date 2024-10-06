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
        return $this->productRepository->store($request);
    }
}
