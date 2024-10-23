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
            ->editColumn('status', function ($model) {
                $checked = $model->status == 1 ? 'checked' : '';
                return '<div class="form-check form-switch"><input data-url="' . route('admin.coupon.status', $model->id) . '" class="form-check-input" type="checkbox" role="switch" name="status" id="status' . $model->id . '" ' . $checked . ' data-id="' . $model->id . '"></div>';
            })
            ->addColumn('action', function ($model) {
                return view('backend.coupon.action', compact('model'));
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function find($id)
    {
        return Coupon::findOrFail($id);
    }

    public function create($data)
    {
        Coupon::create([
            'coupon_code' => $data->coupon_code,
            'minimum_shipping_amount' => $data->minimum_shipping_amount,
            'discount_amount' => $data->discount_amount,
            'discount_type' => $data->discount_type,
            'maximum_discount_amount' => $data->maximum_discount_amount,
            'start_date' => $data->start_date ? date('Y-m-d', strtotime($data->start_date)) : null,
            'end_date' => $data->end_date ? date('Y-m-d', strtotime($data->end_date)) : null,
            'status' => $data->status
        ]);

        $json = ['status' => true, 'load' => true, 'message' => 'Coupon created successfully'];
        return response()->json($json);
    }

    public function update($id, $data)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->coupon_code = $data->coupon_code;
        $coupon->minimum_shipping_amount = $data->minimum_shipping_amount;
        $coupon->discount_amount = $data->discount_amount;
        $coupon->discount_type = $data->discount_type;
        $coupon->maximum_discount_amount = $data->maximum_discount_amount;
        $coupon->start_date = $data->start_date ? date('Y-m-d', strtotime($data->start_date)) : null;
        $coupon->end_date = $data->end_date ? date('Y-m-d', strtotime($data->end_date)) : null;
        $coupon->status = $data->status;
        $coupon->update();

        return response()->json(['status' => true, 'load' => true, 'message' => 'Coupon updated successfully.']);
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
