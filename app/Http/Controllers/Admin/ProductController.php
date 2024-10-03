<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\ProductSpecificationRepositoryInterface;

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
    {
        return view('backend.product.index');
    }

    public function create(Request $request)
    {
        if(isset($request->parent_id)){

            return response()->json(['subs'=>$this->categoryRepository->categoriesDropDown($request)]);
        }
        $categories=$this->categoryRepository->categoriesDropDown(null);
        return view('backend.product.create',compact('categories'));
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
