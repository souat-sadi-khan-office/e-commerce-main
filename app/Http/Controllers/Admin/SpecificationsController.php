<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SpecificationKey;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\ProductSpecificationRepositoryInterface;

class SpecificationsController extends Controller
{

    private $productSpecificationRepository;

    public function __construct(ProductSpecificationRepositoryInterface $productSpecificationRepository)
    {
        $this->productSpecificationRepository = $productSpecificationRepository;
    }
    public function index(Request $request)
    {
        $categories = $this->productSpecificationRepository->index($request);
        // dd($categories);
        $view = $this->productSpecificationRepository->indexview($categories);
        // dd($view);
        if ($request->ajax()) {
            return $view;
        }
        return view('backend.category.specificationKeys.index');
    }
    public function show(Request $request,$id){
        $models=SpecificationKey::where('category_id',$id)->with('admin')->get();

        return view('backend.category.specificationKeys.keysModal',compact('models'));
    }
    public function updatestatus($id)
   {

      return $this->productSpecificationRepository->updatestatus($id);
   }
   public function updateposition(Request $request,$id)
   {

      return $this->productSpecificationRepository->updateposition($request,$id);
   }
   public function delete($id)
   {

      return $this->productSpecificationRepository->delete($id);
   }
}

