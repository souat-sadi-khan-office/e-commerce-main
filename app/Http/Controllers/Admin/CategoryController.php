<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\CPU\Images;
use App\CPU\Helpers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\CategoryRepositoryInterface;

class CategoryController extends Controller
{
   protected $categoryRepository;

   public function __construct(CategoryRepositoryInterface $categoryRepository)
   {
      $this->categoryRepository = $categoryRepository;
   }

   public function store(Request $request)
   {

      return $this->categoryRepository->store($request);
   }
   public function addform()
   {
      return view('backend.category.add');
   }
   public function addformsub()
   {
      $categories = $this->categoryRepository->categoriesDropDown();
      return view('backend.category.sub.add', compact('categories'));
   }

   public function updateisFeatured(Request $request, $id)
    {

    return $this->categoryRepository->updateisFeatured($request, $id);
       
    }

    public function updatestatus(Request $request, $id)
    {

    return $this->categoryRepository->updatestatus($request, $id);
       
    }
    

   public function index(Request $request)
   {
      if ($request->has('sub')) {
      } else {

         if ($request->ajax()) {

            $models = $this->categoryRepository->index($request);
            return Datatables::of($models)
               ->addIndexColumn()
               ->editColumn('status', function ($model) {
                  $checked = $model->status == 1 ? 'checked' : '';
                  return '<input data-url="'. route('admin.category.status', $model->id) .'" class="form-check-input" type="checkbox" role="switch" name="status" id="status' . $model->id . '" ' . $checked . ' data-id="' . $model->id . '">';
               })
               ->editColumn('photo', function ($model) {
                  return Images::show($model->photo);;
               })
               ->editColumn('icon', function ($model) {
                  return $model->icon;
               })
               ->editColumn('admin_id', function ($model) {
                  return Helpers::adminName($model->admin_id);
               })
               ->editColumn('is_featured', function ($model) {
                  $checked = $model->is_featured == 1 ? 'checked' : '';
                  return '<input data-url="'. route('admin.category.is_featured', $model->id) .'" class="form-check-input" type="checkbox" role="switch" name="is_featured" id="is_featured_' . $model->id . '" ' . $checked . ' data-id="' . $model->id . '">';
               })
               ->addColumn('action', function ($model) {
                  return view('backend.zone.action', compact('model'));
               })
               ->rawColumns(['action', 'photo', 'status', 'icon', 'admin_id', 'is_featured'])
               ->make(true);
         }

         return view('backend.category.index');
      }
   }
}
