<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SpecificationKey;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\ProductSpecificationRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SpecificationsController extends Controller
{

    private $productSpecificationRepository;

    public function __construct(ProductSpecificationRepositoryInterface $productSpecificationRepository)
    {
        $this->productSpecificationRepository = $productSpecificationRepository;
    }

    public function update(Request $request, $categoryId) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|array',
            'position' => 'required|array',
            'status' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'status' => false, 'validator' => true, 'message' => $validator->errors()]);
        }

        if(count($request->id) > 0) {
            foreach ($request->id as $i => $id) {
                if ($id) {
                    SpecificationKey::updateOrCreate(
                        ['id' => $id],
                        [
                            'name' => $request->name[$i], 
                            'status' => $request->status[$i],
                            'position' => $request->position[$i]
                        ]
                    );
                } else {
                    SpecificationKey::create([
                        'name' => $request->name[$i],
                        'status' => $request->status[$i],
                        'position' => $request->position[$i],
                        'admin_id' => Auth::guard('admin')->user()->id,
                        'category_id' => $categoryId
                    ]);
                }
            }
        }

        $remove_ids = $request->remove_ids;
        if($remove_ids != '') {
            $idArray = explode(',', $remove_ids);
            if(count($idArray) > 0) {
                foreach($idArray as $idItem) {
                    $spec = SpecificationKey::find($idItem);
                    if($spec) {
                        $spec->delete();
                    }
                }
            }
        }

        return response()->json(['success' => true, 'status' => true, 'load' => true, 'message' => 'Keys updated successfully.']);
    }

    public function index(Request $request)
    {
        $categories = $this->productSpecificationRepository->index();
        // dd($categories);
        $view = $this->productSpecificationRepository->indexview($categories);
        // dd($view);
        if ($request->ajax()) {
            return $view;
        }
        return view('backend.category.specificationKeys.index');
    }

    public function create()
    {
        $categories = $this->productSpecificationRepository->index();
        return view('backend.category.specificationKeys.create',compact('categories'));
    }

    public function store(Request $request){
        return $this->productSpecificationRepository->store($request);
    }
    public function show(Request $request,$id){
        $models=SpecificationKey::where('category_id',$id)->with('admin')->orderBy('position')->get();

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

