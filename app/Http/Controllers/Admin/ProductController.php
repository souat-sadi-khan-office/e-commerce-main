<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\ProductSpecificationRepositoryInterface;
use App\Repositories\Interface\TaxRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;

class ProductController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;
    protected $specificationRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository,
     ProductRepositoryInterface $productRepository,
     ProductSpecificationRepositoryInterface $specificationRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->specificationRepository = $specificationRepository;
    }

    public function index()
    private $taxRepository;
    private $productRepository;

    public function __construct(
        TaxRepositoryInterface $taxRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->taxRepository = $taxRepository;
        $this->productRepository = $productRepository;
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
        if(isset($request->parent_id)){

            return response()->json(['subs'=>$this->categoryRepository->categoriesDropDown($request)]);
        }
        $categories=$this->categoryRepository->categoriesDropDown(null);
        return view('backend.product.create',compact('categories'));
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
        if(isset($request->category_id)){

            return response()->json(['keys'=>$this->specificationRepository->keys($request->category_id)]);
        }elseif($request->key_id){
            return response()->json(['types'=>$this->specificationRepository->types($request->key_id)]);

        }elseif($request->type_id){
            return response()->json(['attributes'=>$this->specificationRepository->attributes($request->type_id)]);

        }
        return false;
       
    }

}
