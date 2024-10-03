<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SpecificationKey;
use App\Http\Controllers\Controller;
use App\Models\SpecificationKeyType;
use App\Repositories\Interface\ProductSpecificationRepositoryInterface;

class SpecificationsTypes extends SpecificationsController
{

    private $productSpecificationRepository;

    public function __construct(ProductSpecificationRepositoryInterface $productSpecificationRepository)
    {
        $this->productSpecificationRepository = $productSpecificationRepository;
    }
    public function index(Request $request)
    {
        $keys = $this->productSpecificationRepository->typesindex();
       
        $view = $this->productSpecificationRepository->typesindexview($keys);
        // dd($view);
        if ($request->ajax()) {
            return $view;
        }
        return view('backend.category.specificationKeys.types.index');
    }

    public function create()
    {
        $keys = $this->productSpecificationRepository->typesindex();
        return view('backend.category.specificationKeys.types.create',compact('keys'));
    }

    public function store(Request $request){
        return $this->productSpecificationRepository->typesstore($request);
    }
    public function show(Request $request,$id){
        $models=SpecificationKeyType::where('specification_key_id',$id)->with('admin')->orderBy('position')->get();
        return view('backend.category.specificationKeys.types.typesModal',compact('models'));
    }

    public function updatestatus($id)
   {

      return $this->productSpecificationRepository->typesupdatestatus($id);
   }
   public function filterstatus($id)
   {

      return $this->productSpecificationRepository->typesfilterstatus($id);
   }
   public function updateposition(Request $request,$id)
   {

      return $this->productSpecificationRepository->typesupdateposition($request,$id);
   }
   public function delete($id)
   {

      return $this->productSpecificationRepository->typesdelete($id);
   }
}

