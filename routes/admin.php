<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HelperController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SpecificationsController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\StuffController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BrandTypeController;
use App\Http\Controllers\Admin\ConfigurationSettingController;
use App\Http\Controllers\Admin\CurrencyController;

Route::get('/', function() {
    return redirect()->route('admin.login');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login/post', [LoginController::class, 'login'])->name('login.post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['isAdmin', 'web'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');



    Route::group(['prefix' => 'categories', 'as' => 'category.'], function () {
        Route::get('add', [CategoryController::class, 'addform'])->name('add');
        Route::get('sub/add', [CategoryController::class, 'addformsub'])->name('sub.add');
        Route::any('store', [CategoryController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::any('delete/{id}', [CategoryController::class, 'delete'])->name('delete');
        Route::any('update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('sub', [CategoryController::class, 'indexsub'])->name('index.sub');
    
        Route::group(['prefix' => 'specification', 'as' => 'specification.'], function () {
            Route::get('key/add', [SpecificationsController::class, 'keyadd'])->name('key.add'); // Corrected syntax here
        });
    });
    Route::post('category/is/featured/{id}', [CategoryController::class, 'updateisFeatured'])->name('category.is_featured');
    Route::post('category/status/{id}', [CategoryController::class, 'updatestatus'])->name('category.status');
    Route::any('/slug-check', [HelperController::class, 'checkSlug'])->name('slug.check');

    // Brand Types
    Route::resource('brand-type', BrandTypeController::class);
    
    // Brand
    Route::resource('brand', BrandController::class);

    // Country
    Route::resource('city', CityController::class);
    
    // Country
    Route::resource('country', CountryController::class);

    // Zone
    Route::post('zone/status/{id}', [ZoneController::class, 'updateStatus'])->name('zone.status');
    Route::resource('zone', ZoneController::class);

    // Stuff
    Route::resource('stuff', StuffController::class);

    // Roles Route
    Route::resource('roles', RoleController::class);

    // Currency
    Route::resource('currency', CurrencyController::class);

    // Settings
    Route::controller(ConfigurationSettingController::class)->group(function () {
        Route::get('settings/general','general')->name('settings.general');
        Route::get('settings/vat','vat')->name('settings.vat');

        Route::post('settings/update', 'update')->name('settings.update');
    });

    // System
    Route::view('/server-status', 'backend.system.server_status')->name('system_server');
});

// Add this to your web.php for testing purposes
Route::get('/livewire-components', function () {
    return response()->json(\Livewire\Livewire::getComponentNames());
});
