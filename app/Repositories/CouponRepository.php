<?php

namespace App\Repositories;

use DataTables;
use App\CPU\Images;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interface\CouponRepositoryInterface;

class CouponRepository implements CouponRepositoryInterface
{
    public function all()
    {
        return Coupon::all();
    }

    public function dataTable()
    {
        $models = $this->all();
        return Datatables::of($models)
            ->addIndexColumn()
            ->editColumn('image', function ($model) {
                return Images::show($model->image);
            })
            ->editColumn('created_by', function ($model) {
                return $model->admin->name;
            })
            ->editColumn('banner_type', function ($model) {
                $bannerType = "-";

                switch ($model->banner_type) {
                    case 'main':
                        $bannerType = "Main Banner";
                        break;
                    case 'main_sidebar':
                        $bannerType = "Main Sidebar Banner";
                        break;
                    case 'mid':
                        $bannerType = "Mid Website Banner";
                        break;
                    case 'footer':
                        $bannerType = "Footer Banner";
                        break;
                }

                return $bannerType;
            })
            ->editColumn('status', function ($model) {
                $checked = $model->status == 1 ? 'checked' : '';
                return '<div class="form-check form-switch"><input data-url="' . route('admin.banner.status', $model->id) . '" class="form-check-input" type="checkbox" role="switch" name="status" id="status' . $model->id . '" ' . $checked . ' data-id="' . $model->id . '"></div>';
            })
            ->addColumn('action', function ($model) {
                return view('backend.banner.action', compact('model'));
            })
            ->rawColumns(['action', 'status', 'created_by', 'banner_type', 'image'])
            ->make(true);
    }

    public function find($id)
    {
        return Coupon::findOrFail($id);
    }

    public function create($data)
    {
        Banner::create([
            'coupon_code' => $data->coupon_code,
            'minimum_shipping_amount' => $data->minimum_shipping_amount,
            'discount_amount' => $data->discount_amount,
            'discount_type' => $data->discount_type,
            'maximum_discount_amount' => $data->maximum_discount_amount,
            'start_date' => date('Y-m-d', strtotime($data->start_date)),
            'end_date' => date('Y-m-d', strtotime($data->end_date)),
            'status' => $data->status
        ]);

        $json = ['status' => true, 'message' => 'Coupon created successfully'];
        return response()->json($json);
    }

    public function update($id, $data)
    {
        $coupon = Banner::findOrFail($id);
        $coupon->coupon_code = $data->coupon_code;
        $coupon->minimum_shipping_amount = $data->minimum_shipping_amount;
        $coupon->discount_amount = $data->discount_amount;
        $coupon->discount_type = $data->discount_type;
        $coupon->maximum_discount_amount = $data->maximum_discount_amount;
        $coupon->start_date = date('Y-m-d', strtotime($data->start_date));
        $coupon->end_date = date('Y-m-d', strtotime($data->end_date));
        $coupon->status = $data->status;
        $coupon->update();

        return response()->json(['status' => true, 'message' => 'Coupon updated successfully.']);
    }

    public function delete($id)
    {
        $coupon = Coupon::findOrFail($id);
        return $coupon->delete();
    }

    public function updateStatus($request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $coupon = Coupon::find($id);

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Coupon not found.'], 404);
        }

        $coupon->status = $request->input('status');
        $coupon->save();
        return response()->json(['success' => true, 'message' => 'Coupon status updated successfully.']);
    }
}
