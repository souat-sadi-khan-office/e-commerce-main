<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\CPU\Images;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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
                    return Images::show($model->logo);
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
                    return view('backend.brands.action', compact('model'));
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

    public function store(BrandRequest $request)
    {
        return $this->brandRepository->createBrand($request);
    }

    public function edit($id)
    {
        $model = $this->brandRepository->findBrandById($id);
        return view('backend.brands.edit', compact('model'));
    }

    public function update(BrandRequest $request, $id)
    {
        return $this->brandRepository->updateBrand($id, $request);
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
