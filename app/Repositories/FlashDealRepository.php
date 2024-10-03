<?php

namespace App\Repositories;

use DataTables;
use App\CPU\Images;
use App\Models\FlashDeal;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interface\FlashDealRepositoryInterface;

class FlashDealRepository implements FlashDealRepositoryInterface
{
    public function getAllDeals()
    {
        return FlashDeal::all();
    }

    public function dataTable()
    {
        $models = $this->getAllDeals();
        return Datatables::of($models)
            ->addIndexColumn()
            ->editColumn('banner', function ($model) {
                return Images::show($model->banner);
            })
            ->editColumn('created_by', function ($model) {
                return $model->creator->name;
            })
            ->editColumn('start_date', function ($model) {
                return format_date($model->starting_time);
            })
            ->editColumn('end_date', function ($model) {
                return "End date";
            })
            ->editColumn('status', function ($model) {
                $checked = $model->status == 1 ? 'checked' : '';
                return '<div class="form-check form-switch"><input data-url="' . route('admin.brand.status', $model->id) . '" class="form-check-input" type="checkbox" role="switch" name="status" id="status' . $model->id . '" ' . $checked . ' data-id="' . $model->id . '"></div>';
            })
            
            ->addColumn('action', function ($model) {
                return view('backend.deal.action', compact('model'));
            })
            ->rawColumns(['action', 'status', 'created_by', 'end_date', 'start_date', 'banner'])
            ->make(true);
    }

    public function findDealById($id)
    {
        return FlashDeal::findOrFail($id);
    }

    public function createDeal($data)
    {
        $brand = FlashDeal::create([
            'title' => $data->title,
            'admin_id' => Auth::guard('admin')->id(),
            'slug' => $data->slug,
            'status' => $data->status,
            'starting_time' => $data->starting_time,
            'deadline_time' => $data->deadline_time,
            'deadline_type' => $data->deadline_type,
            'description' => $data->description,
            'site_title' => $data->site_title,
            'meta_title' => $data->meta_title,
            'meta_keyword' => $data->meta_keyword,
            'meta_description' => $data->meta_description,
            'meta_article_tag' => $data->meta_article_tag,
            'meta_script_tag' => $data->meta_script_tag,
            'image' => $data->image ? Images::upload('deals', $data->image) : null,
        ]);

        $json = ['status' => true, 'goto' => route('admin.flash-deal.index'), 'message' => 'Deal created successfully'];
        return response()->json($json);
    }

    public function updateDeal($id, $data)
    {
        $deal = FlashDeal::findOrFail($id);
        $deal->admin_id  = Auth::guard('admin')->id();
        $deal->title = $data->title;
        $deal->slug = $data->slug;
        $deal->status = $data->status;
        $deal->starting_time = $data->starting_time;
        $deal->deadline_time = $data->deadline_time;
        $deal->deadline_type = $data->deadline_type;
        $deal->description = $data->description;
        $deal->site_title = $data->site_title;
        $deal->meta_title = $data->meta_title;
        $deal->meta_keyword = $data->meta_keyword;
        $deal->meta_description = $data->meta_description;
        $deal->meta_article_tag = $data->meta_article_tag;
        $deal->meta_script_tag = $data->meta_script_tag;

        if($data->image) {
            $deal->image = Images::upload('deals', $data->image);
        }

        $deal->update();

        return response()->json(['status' => true, 'goto' => route('admin.flash-deal.index'), 'message' => 'Deal updated successfully.']);
    }

    public function deleteDeal($id)
    {
        $brand = FlashDeal::findOrFail($id);
        return $brand->delete();
    }

    public function updateStatus($request, $id) 
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $flashDeal = FlashDeal::find($id);

        if (!$flashDeal) {
            return response()->json(['success' => false, 'message' => 'Flash deal not found.'], 404);
        }

        $flashDeal->status = $request->input('status');
        $flashDeal->save();

        return response()->json(['success' => true, 'message' => 'Flash deal status updated successfully.']);
    }
}