<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LaptopFinderFeaturesRequest;
use App\Repositories\Interface\LaptopFinderFeaturesRepositoryInterface;

class LaptopFinderFeaturesController extends Controller
{
    private $laptopFinderFeaturesRepository;

    public function __construct(
        LaptopFinderFeaturesRepositoryInterface $laptopFinderFeaturesRepository,
    ) {
        $this->laptopFinderFeaturesRepository = $laptopFinderFeaturesRepository;
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {

            return $this->laptopFinderFeaturesRepository->dataTable();
        }

        return view('backend.laptop-finder.features.index');
    }

    public function create()
    {
        return view('backend.laptop-finder.features.create');
    }

    public function store(LaptopFinderFeaturesRequest $request)
    {
        return $this->laptopFinderFeaturesRepository->create($request);
    }

    public function show()
    {
        
    }

    public function edit($id)
    {
        $model = $this->laptopFinderFeaturesRepository->find($id);
        return view('backend.laptop-finder.features.edit', compact('model'));
    }

    public function update(LaptopFinderFeaturesRequest $request, $id)
    {
        return $this->laptopFinderFeaturesRepository->update($id, $request);
    }

    public function destroy($id)
    {
        $this->laptopFinderFeaturesRepository->delete($id);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "Record deleted successfully"
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        return $this->laptopFinderFeaturesRepository->updateStatus($request, $id);
    }
}
