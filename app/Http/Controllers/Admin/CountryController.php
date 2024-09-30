<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Zone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\CountryRepositoryInterface;

class CountryController extends Controller
{
    private $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {

            $models = $this->countryRepository->getAllCountries();
            return Datatables::of($models)
                ->addIndexColumn()
                ->editColumn('zone', function ($model) {
                    return $model->zone->name;
                })
                ->editColumn('status', function ($model) {
                    return $model->status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('action', function ($model) {
                    return view('backend.countries.action', compact('model'));
                })
                ->rawColumns(['action', 'status', 'zone'])
                ->make(true);
        }

        return view('backend.countries.index');
    }

    public function create()
    {
        $zones = Zone::where('status', 1)->get();
        return view('backend.countries.create', compact('zones'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'zone_id'   => 'required',
            'name'      => 'required|string|max:255',
            'status'    => 'required',
        ]);

        $this->countryRepository->createCountry($data);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "Country created successfully"
        ]);
    }

    public function edit($id)
    {
        $model = $this->countryRepository->findCountryById($id);
        $zones = Zone::where('status', 1)->get();
        return view('backend.countries.edit', compact('model', 'zones'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'zone_id'   => 'required',
            'name'      => 'required|string|max:255',
            'status'    => 'required|string',
        ]);

        $this->countryRepository->updateCountry($id, $data);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "Country updated successfully"
        ]);
    }

    public function destroy($id)
    {
        $this->countryRepository->deleteCountry($id);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "Country deleted successfully"
        ]);
    }
}
