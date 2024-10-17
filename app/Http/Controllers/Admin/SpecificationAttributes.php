<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SpecificationKeyTypeAttribute;
use App\Repositories\Interface\ProductSpecificationRepositoryInterface;

class SpecificationAttributes extends SpecificationsTypes
{
    private $productSpecificationRepository;

    public function __construct(ProductSpecificationRepositoryInterface $productSpecificationRepository)
    {
        $this->productSpecificationRepository = $productSpecificationRepository;
    }

    public function index(Request $request)
    {
        $keys = $this->productSpecificationRepository->attributeindex();
       
        $view = $this->productSpecificationRepository->attributeindexview($keys);
        // dd($view);
        if ($request->ajax()) {
            return $view;
        }
        return view('backend.category.specificationKeys.types.attributes.index');
    }

    public function create()
    {
        $keys = $this->productSpecificationRepository->attributeindex();
        
        return view('backend.category.specificationKeys.types.attributes.create',compact('keys'));
    }

    public function store(Request $request){
        // dd($request->all());
        return $this->productSpecificationRepository->attributesstore($request);
    }
    public function show(Request $request,$id){
        $models = SpecificationKeyTypeAttribute::where('key_type_id',$id)->with('admin')->get();
        return view('backend.category.specificationKeys.types.attributes.attributesModal',compact('models'));
    }

    public function updatestatus($id)
   {

      return $this->productSpecificationRepository->attributeupdatestatus($id);
   }
   public function update(Request $request,$id)
   {

      return $this->productSpecificationRepository->attributeupdate($request,$id);
   }
   public function delete($id)
   {

      return $this->productSpecificationRepository->attributedelete($id);
   }
}
