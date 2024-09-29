<?php

namespace App\Repositories;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interface\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    public function getAllAdmins()
    {
        return Admin::all();
    }

    public function getAdminById($id)
    {
        return Admin::findOrFail($id);
    }

    public function createAdmin($data)
    {
        $data['password'] = Hash::make($data['password']);
        return Admin::create($data);
    }

    public function updateAdmin($id, array $data)
    {
        $admin = Admin::findOrFail($id);
        
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $admin->update($data);
        return $admin;
    }

    public function deleteAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
    }
}