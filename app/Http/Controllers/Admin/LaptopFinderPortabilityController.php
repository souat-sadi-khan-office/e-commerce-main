<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LaptopFinderPortabilityRequest;
use App\Repositories\Interface\LaptopFinderPortabilityRepositoryInterface;

class LaptopFinderPortabilityController extends Controller
{
    private $laptopFinderPortabilityRepository;

    public function __construct(
        LaptopFinderPortabilityRepositoryInterface $laptopFinderPortabilityRepository,
    ) {
        $this->laptopFinderPortabilityRepository = $laptopFinderPortabilityRepository;
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {

            return $this->laptopFinderPortabilityRepository->dataTable();
        }

        return view('backend.laptop-finder.portable.index');
    }

    public function create()
    {
        return view('backend.laptop-finder.portable.create');
    }

    public function store(LaptopFinderPortabilityRequest $request)
    {
        return $this->laptopFinderPortabilityRepository->create($request);
    }

    public function show()
    {
        
    }

    public function edit($id)
    {
        $model = $this->laptopFinderPortabilityRepository->find($id);
        return view('backend.laptop-finder.portable.edit', compact('model'));
    }

    public function update(LaptopFinderPortabilityRequest $request, $id)
    {
        return $this->laptopFinderPortabilityRepository->update($id, $request);
    }

    public function destroy($id)
    {
        $this->laptopFinderPortabilityRepository->delete($id);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "Record deleted successfully"
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        return $this->laptopFinderPortabilityRepository->updateStatus($request, $id);
    }
}
