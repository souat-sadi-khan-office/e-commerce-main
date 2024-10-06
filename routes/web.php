<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('fontend.homepage.index');
})->name('home');


Route::post('search/category', [SearchController::class, 'searchByCategory'])->name('search.category');
Route::post('search/brands', [SearchController::class, 'searchByBrands'])->name('search.brands');
Route::post('search/product', [SearchController::class, 'searchByProduct'])->name('search.product');
Route::post('search/product-data', [SearchController::class, 'searchForProductDetails'])->name('search.product_data');
Route::post('search/brand-types', [SearchController::class, 'searchForBrandTypes'])->name('search.brand-types');
