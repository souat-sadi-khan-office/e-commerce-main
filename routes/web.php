<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\PhoneBookController;
use App\Http\Controllers\Frontend\AddressController;

Route::get('/', function () {
    return view('frontend.homepage.index');
})->name('home');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('login/post', [LoginController::class, 'login'])->name('login.post');
Route::post('register/post', [RegisterController::class, 'register'])->name('register.post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['isCustomer', 'web'])->group(function () {
    Route::get('account', function() {
        return redirect()->route('dashboard');
    });
    Route::get('dashboard', function() {
        return redirect()->route('dashboard');
    });

    Route::get('account/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::prefix('account')->name('account.')->group(function () {
        Route::resource('phone-book', PhoneBookController::class);
        Route::resource('address-book', AddressController::class);
        Route::get('my-orders', [UserController::class, 'myOrders'])->name('my_orders');
        Route::get('quotes', [UserController::class, 'quotes'])->name('quote');
        Route::get('edit-profile', [UserController::class, 'profile'])->name('edit_profile');
        Route::post('update-profile', [UserController::class, 'updateProfile'])->name('update.profile');
        Route::get('change-password', [UserController::class, 'password'])->name('change_password');
        Route::post('update-password', [UserController::class, 'updatePassword'])->name('update.password');
        Route::get('wish-list', [UserController::class, 'wishlist'])->name('wishlist');
        Route::get('saved-pc', [UserController::class, 'saved_pc'])->name('saved_pc');
        Route::get('star-points', [UserController::class, 'star_points'])->name('star_points');
        Route::get('transaction', [UserController::class, 'transactions'])->name('transaction');
    });
});

Route::post('search/category', [SearchController::class, 'searchByCategory'])->name('search.category');
Route::post('search/category-by-id', [SearchController::class, 'searchByCategoryId'])->name('search.category_by_id');
Route::post('search/brand-by-id', [SearchController::class, 'searchByBrandId'])->name('search.brand_by_id');
Route::post('search/brands', [SearchController::class, 'searchByBrands'])->name('search.brands');
Route::post('search/product', [SearchController::class, 'searchByProduct'])->name('search.product');
Route::post('search/product-stock', [SearchController::class, 'searchForProductStock'])->name('search.product_stock');
Route::post('search/product-data', [SearchController::class, 'searchForProductDetails'])->name('search.product_data');
Route::post('search/brand-types', [SearchController::class, 'searchForBrandTypes'])->name('search.brand-types');

Route::get('/get-countries', [AddressController::class, 'getCountriesByZone'])->name('getCountries');
Route::get('/get-cities', [AddressController::class, 'getCitiesByCountry'])->name('getCities');
