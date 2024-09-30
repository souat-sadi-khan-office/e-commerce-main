<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interface\CityRepositoryInterface;

class CityController extends Controller
{
    private $cityRepository;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {

            $models = $this->cityRepository->getAllCities();
            return Datatables::of($models)
                ->addIndexColumn()
                ->editColumn('country', function ($model) {
                    return $model->country->name;
                })
                ->editColumn('status', function ($model) {
                    return $model->status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('action', function ($model) {
                    return view('backend.cities.action', compact('model'));
                })
                ->rawColumns(['action', 'status', 'zone'])
                ->make(true);
        }

        return view('backend.cities.index');
    }

    public function create()
    {
        $countries = Country::where('status', 1)->get();
        return view('backend.cities.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'country_id'   => 'required',
            'name'      => 'required|string|max:255',
            'status'    => 'required',
        ]);

        $this->cityRepository->createCity($data);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "City created successfully"
        ]);
    }

    public function edit($id)
    {
        $model = $this->cityRepository->findCityById($id);
        $countries = Country::where('status', 1)->get();
        return view('backend.cities.edit', compact('model', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'country_id'   => 'required',
            'name'      => 'required|string|max:255',
            'status'    => 'required|string',
        ]);

        $this->cityRepository->updateCity($id, $data);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "City updated successfully"
        ]);
    }

    public function destroy($id)
    {
        $this->cityRepository->deleteCity($id);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "City deleted successfully"
        ]);
    }
}
