<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\UserController;

Route::get('/', function () {
    return view('fontend.homepage.index');
})->name('home');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register/post', [RegisterController::class, 'register'])->name('register.post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['isCustomer', 'web'])->group(function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
});

Route::post('search/category', [SearchController::class, 'searchByCategory'])->name('search.category');
Route::post('search/category-by-id', [SearchController::class, 'searchByCategoryId'])->name('search.category_by_id');
Route::post('search/brand-by-id', [SearchController::class, 'searchByBrandId'])->name('search.brand_by_id');
Route::post('search/brands', [SearchController::class, 'searchByBrands'])->name('search.brands');
Route::post('search/product', [SearchController::class, 'searchByProduct'])->name('search.product');
Route::post('search/product-stock', [SearchController::class, 'searchForProductStock'])->name('search.product_stock');
Route::post('search/product-data', [SearchController::class, 'searchForProductDetails'])->name('search.product_data');
Route::post('search/brand-types', [SearchController::class, 'searchForBrandTypes'])->name('search.brand-types');
