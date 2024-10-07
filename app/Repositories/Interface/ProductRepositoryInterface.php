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
    public function duplicateProduct($request, $id);
    public function specificationproducts();
    public function specificationproductsDatatable();
    public function specificationproductModal($id);
    public function keyfeature($id);
    public function specificationsAdd($request,$id);
    public function delete($id);
}