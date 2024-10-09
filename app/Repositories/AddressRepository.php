<?php

namespace App\Repositories;

use DataTables;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interface\AddressControllerInterface;

class AddressRepository implements AddressControllerInterface
{
    public function getAll()
    {
        return UserAddress::all();
    }
    
    public function getAllByUser()
    {
        return UserAddress::where('user_id', Auth::guard('customer')->user()->id)->orderBy('id', 'DESC')->get();
    }

    public function findModelById($id)
    {
        return UserAddress::findOrFail($id);
    }

    public function createModel(array $data)
    {
        if ($data['is_default'] == 1) {
            UserAddress::where('user_id', Auth::guard('customer')->user()->id)->update(['is_default' => 0]);
        }

        return UserAddress::create([
            'user_id' => Auth::guard('customer')->user()->id,
            'zone_id' => $data['zone_id'],
            'country_id' => $data['country_id'],
            'city_id' => $data['city_id'],
            'area_id' => $data['area_id'],
            'address' => $data['address'],
            'postcode' => $data['postcode'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'company_name' => $data['company_name'],
            'is_default' => $data['is_default']
        ]);
    }

    public function updateModel($id, array $data)
    {
        if ($data['is_default'] == 1) {
            UserAddress::where('user_id', Auth::guard('customer')->user()->id)->update(['is_default' => 0]);
        }
        
        $model = UserAddress::findOrFail($id);
        $model->update($data);

        return $model;
    }

    public function deleteModel($id)
    {
        $model = UserAddress::findOrFail($id);
        return $model->delete();
    }
}