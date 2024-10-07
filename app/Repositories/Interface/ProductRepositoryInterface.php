<?php

namespace App\Repositories\Interface;

interface ProductRepositoryInterface
{
    public function index($request);
    public function storeProduct($request);
    public function updateProduct($request, $id);
    public function dataTable();
    public function updateStatus($request, $id);
    public function getProductById($id);
    public function updateFeatured($request, $id);
    public function deleteProduct($id);
    public function getProductStockPurchaseDetails($id);
}