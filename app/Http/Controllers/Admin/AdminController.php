<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\Interface\BrandRepositoryInterface;
use App\Repositories\Interface\CustomerRepositoryInterface;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\DashBoardRepositoryInterface;

class AdminController extends Controller
{
    private $customer;
    private $category;
    private $brand;
    private $dashboard;

    public function __construct(
        BrandRepositoryInterface $brand,
        CustomerRepositoryInterface $customer,
        CategoryRepositoryInterface $category,
        DashBoardRepositoryInterface $dashboard,
    ) {
        $this->customer = $customer;
        $this->category = $category;
        $this->brand = $brand;
        $this->dashboard = $dashboard;
    }

    public function index()
    {
        $data=$this->dashboard->index(true);
        // dd($data);
        $number_of_order = 0;
        $number_of_brand = $this->brand->getAllBrands()->count();
        $number_of_customer = $this->customer->getAllCustomers()->count();
        $number_of_category = $this->category->getAllCategories()->count();

        return view('backend.dashboard', compact('data'));
    }
}
