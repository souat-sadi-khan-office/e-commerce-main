<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interface\ZoneRepositoryInterface;

class ZoneController extends Controller
{
    private $zoneRepository;

    public function __construct(ZoneRepositoryInterface $zoneRepository)
    {
        $this->zoneRepository = $zoneRepository;
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {

            $models = $this->zoneRepository->getAllZone();
            return Datatables::of($models)
                ->addIndexColumn()
                ->editColumn('status', function ($model) {
                    return $model->status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('action', function ($model) {
                    return view('backend.zone.action', compact('model'));
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('backend.zone.index');
    }

    public function create()
    {
        return view('backend.zone.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        $this->zoneRepository->createZone($data);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "Zone created successfully"
        ]);
    }

    public function edit($id)
    {
        $model = $this->zoneRepository->findZoneById($id);
        return view('backend.zone.edit', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $this->zoneRepository->updateZone($id, $data);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "Zone updated successfully"
        ]);
    }

    public function destroy($id)
    {
        $this->zoneRepository->deleteZone($id);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "Admin deleted successfully"
        ]);
    }
}
