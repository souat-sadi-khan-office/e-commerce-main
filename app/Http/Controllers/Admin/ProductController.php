<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\TaxRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;

class ProductController extends Controller
{
    private $taxRepository;
    private $productRepository;

    public function __construct(
        TaxRepositoryInterface $taxRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->taxRepository = $taxRepository;
        $this->productRepository = $productRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->productRepository->dataTable();
        }

        return view('backend.product.index');
    }

    public function create()
    {
        $taxes = $this->taxRepository->getAllActiveTaxes();

        return view('backend.product.create', compact('taxes'));
    }

    public function destroy($id)
    {
        $this->productRepository->deleteProduct($id);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "Brand deleted successfully"
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        return $this->productRepository->updateStatus($request, $id);
    }
    
    public function updateFeatured(Request $request, $id)
    {
        return $this->productRepository->updateFeatured($request, $id);
    }
}
