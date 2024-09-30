<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interface\BrandRepositoryInterface;

class BrandController extends Controller
{
    private $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {

            $models = $this->brandRepository->getAllBrands();
            return Datatables::of($models)
                ->addIndexColumn()
                ->editColumn('logo', function ($model) {
                    return $model->logo;
                })
                ->editColumn('created_by', function ($model) {
                    return $model->creator->name;
                })
                ->editColumn('status', function ($model) {
                    return $model->status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                })
                ->editColumn('featured', function ($model) {
                    return $model->is_featured == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('action', function ($model) {
                    return view('backend.cities.action', compact('model'));
                })
                ->rawColumns(['action', 'status', 'created_by', 'featured', 'logo'])
                ->make(true);
        }

        return view('backend.brands.index');
    }

    public function create()
    {
        return view('backend.brands.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'              => 'required',
            'logo'              => 'required',
            'is_featured'       => 'required',
            'status'            => 'required',
            'slug'              => 'required|string',
            'description'       => 'required',
            'meta_title'        => 'required|string',
            'meta_keyword'      => 'nullable',
            'meta_description'  => 'required',
            'meta_article_tag'  => 'nullable',
            'meta_script_tag'   => 'nullable',
            'created_by'        => 'required',
        ]);

        $this->brandRepository->createBrand($data);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "Brand created successfully"
        ]);
    }

    public function edit($id)
    {
        $model = $this->brandRepository->findBrandById($id);
        return view('backend.brands.edit', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name'              => 'required',
            'logo'              => 'required',
            'is_featured'       => 'required',
            'status'            => 'required',
            'slug'              => 'required|string',
            'description'       => 'required',
            'meta_title'        => 'required|string',
            'meta_keyword'      => 'nullable',
            'meta_description'  => 'required',
            'meta_article_tag'  => 'nullable',
            'meta_script_tag'   => 'nullable',
            'created_by'        => 'required',
        ]);

        $this->brandRepository->updateBrand($id, $data);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "Brand updated successfully"
        ]);
    }

    public function destroy($id)
    {
        $this->brandRepository->deleteBrand($id);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "Brand deleted successfully"
        ]);
    }
}
