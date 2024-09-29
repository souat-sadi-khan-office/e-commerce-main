<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interface\AdminRepositoryInterface;

class StuffController extends Controller
{
    private $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function index()
    {
        $admins = $this->adminRepository->getAllAdmins();
        return view('backend.stuff.index', compact('admins'));
    }

    public function show($id)
    {
        $admin = $this->adminRepository->getAdminById($id);
        return view('backend.stuff.show', compact('admin'));
    }

    public function create()
    {
        return view('backend.stuff.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'phone' => 'required|string',
            'password' => 'required|string|min:8',
            'avatar' => 'nullable|string',
            'allow_changes' => 'nullable|boolean',
            'last_seen' => 'nullable|date',
            'last_login' => 'nullable|date',
            'address' => 'nullable|string',
            'area' => 'nullable|string',
            'city' => 'nullable|string',
            'country' => 'nullable|string',
            'remember_token' => 'nullable|string',
        ]);

        $this->adminRepository->createAdmin($data);
        return redirect()->route('admin.stuff.index')->with('success', 'Admin created successfully!');
    }

    public function edit($id)
    {
        $admin = $this->adminRepository->getAdminById($id);
        return view('backend.stuff.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'phone' => 'required|string',
            'password' => 'nullable|string|min:8',
            'avatar' => 'nullable|string',
            'allow_changes' => 'nullable|boolean',
            'last_seen' => 'nullable|date',
            'last_login' => 'nullable|date',
            'address' => 'nullable|string',
            'area' => 'nullable|string',
            'city' => 'nullable|string',
            'country' => 'nullable|string',
            'remember_token' => 'nullable|string',
        ]);

        $this->adminRepository->updateAdmin($id, $data);
        return redirect()->route('admin.stuff.index')->with('success', 'Admin updated successfully!');
    }

    public function destroy($id)
    {
        $this->adminRepository->deleteAdmin($id);
        return redirect()->route('admin.stuff.index')->with('success', 'Admin deleted successfully!');
    }
}
