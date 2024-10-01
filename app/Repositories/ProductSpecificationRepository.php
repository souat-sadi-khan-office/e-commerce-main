<?php

namespace App\Repositories;

use DataTables;
use App\CPU\Images;
use App\CPU\Helpers;
use App\Models\Category;
use App\Models\ProductSpecification;
use App\Models\SpecificationKey;
use App\Repositories\Interface\ProductSpecificationRepositoryInterface;


class ProductSpecificationRepository implements ProductSpecificationRepositoryInterface
{
    public function index()
    {
        return Category::select('id', 'name', 'photo', 'status', 'parent_id')
        ->withCount('specificationKeys')
        ->where('status', 1)
        ->orderBy('specification_keys_count', 'desc') 
        ->get();
    }

    public function indexview($models)
    {
        return Datatables::of($models)
            ->addIndexColumn()
            ->editColumn('photo', function ($model) {
                return Images::show($model->photo);
            })
            ->editColumn('specification_keys_count', function ($model) {
                return "<div class='w-100 text-center'>
                            <span class='badge bg-dark rounded-pill' style='padding: 10px 20px;'>
                                " . $model->specification_keys_count . "
                            </span>
                        </div>";
            })
            
            ->editColumn('parent_id', function ($mode) {
                // return $mode->parent_id;
                return $mode->parent_id != null ? Helpers::categoryParent($mode->parent_id) : 'Primary Category';
            })
            ->addColumn('action', function ($model) {
                return view('backend.category.specificationKeys.action', compact('model'));
            })->rawColumns(['action', 'photo', 'parent_id','specification_keys_count'])
            ->make(true);
    }

    public function show($models)
    { 
        return Datatables::of($models)
            ->addIndexColumn()
            ->editColumn('admin_id', function ($model) {
                return $model->admin->name;
            })
            ->addColumn('action', function ($model) {
                return view('backend.category.specificationKeys.action', compact('model'));
            })->rawColumns(['action'])
            ->make(true);
    }

    public function updatestatus($id)
    {

        $key = SpecificationKey::find($id);

        if (!$key) {
            return response()->json(['success' => false, 'message' => 'Key not found.'], 404);
        }

        $key->status = !$key->status;
        $key->save();

        return response()->json(['success' => true, 'message' => 'Key status updated successfully.']);
    }

    public function updateposition($request, $id)
    {
        $request->validate([
            'position' => 'required|integer', // Ensure it's a boolean value
        ]);

        $key = SpecificationKey::find($id);

        if (!$key) {
            return response()->json(['success' => false, 'message' => 'Key not found.'], 404);
        }

        $key->position = $request->input('position');
        $key->save();

        return response()->json(['status' => true, 'stay'=>true, 'message' => 'Key Position updated successfully.']);
    }

    public function delete($id)
    {
        $SpecificationKey = SpecificationKey::findOrFail($id);
        return $SpecificationKey->delete();
    }

    
}