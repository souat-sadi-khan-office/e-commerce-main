<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

     public function store(Request $request){
        return response()->json(['message' => 'Category created successfully!']);
        $massage=$this->categoryRepository->store($request);
     }
     public function addform(){
        return view('backend.category.add');
     }


}
