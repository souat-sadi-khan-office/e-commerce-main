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
use App\Http\Controllers\Admin\SpecificationAttributes;
use App\Http\Controllers\Admin\SpecificationsTypes;

Route::get('/', function () {
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
            Route::get('keys', [SpecificationsController::class, 'index'])->name('key.index');
            Route::get('key/create', [SpecificationsController::class, 'create'])->name('key.create');
            Route::post('key/store', [SpecificationsController::class, 'store'])->name('key.store');
            Route::get('key/show/{id}', [SpecificationsController::class, 'show'])->name('key.show');
            Route::post('status/{id}', [SpecificationsController::class, 'updatestatus'])->name('key.status');
            Route::post('updateposition/{id}', [SpecificationsController::class, 'updateposition'])->name('key.position');
            Route::any('delete/{id}', [SpecificationsController::class, 'delete'])->name('key.delete');

            Route::group(['prefix' => 'types', 'as' => 'type.'], function () {
                Route::get('/', [SpecificationsTypes::class, 'index'])->name('index');
                Route::get('create', [SpecificationsTypes::class, 'create'])->name('create');
                Route::post('store', [SpecificationsTypes::class, 'store'])->name('store');
                Route::get('show/{id}', [SpecificationsTypes::class, 'show'])->name('show');
                Route::post('status/{id}', [SpecificationsTypes::class, 'updatestatus'])->name('status');
                Route::post('show_on_filter/{id}', [SpecificationsTypes::class, 'filterstatus'])->name('filter');
                Route::post('updateposition/{id}', [SpecificationsTypes::class, 'updateposition'])->name('position&filter');
                Route::any('delete/{id}', [SpecificationsTypes::class, 'delete'])->name('delete');


                Route::group(['prefix' => 'attributes', 'as' => 'attribute.'], function () {
                    Route::get('/', [SpecificationAttributes::class, 'index'])->name('index');
                    Route::get('create', [SpecificationAttributes::class, 'create'])->name('create');
                    Route::post('store', [SpecificationAttributes::class, 'store'])->name('store');
                    Route::get('show/{id}', [SpecificationAttributes::class, 'show'])->name('show');
                    Route::post('update/{id}', [SpecificationAttributes::class, 'update'])->name('update');
                    Route::post('status/{id}', [SpecificationAttributes::class, 'updatestatus'])->name('status');
                    Route::any('delete/{id}', [SpecificationAttributes::class, 'delete'])->name('delete');
                });
            });
        });
    });
    Route::post('category/is/featured/{id}', [CategoryController::class, 'updateisFeatured'])->name('category.is_featured');
    Route::post('category/status/{id}', [CategoryController::class, 'updatestatus'])->name('category.status');
    Route::any('/slug-check', [HelperController::class, 'checkSlug'])->name('slug.check');

    // Brand
    Route::resource('brand', BrandController::class);

    // Country
    Route::resource('city', CityController::class);

    // Country
    Route::resource('country', CountryController::class);

    // Zone
    Route::resource('zone', ZoneController::class);

    // Stuff
    Route::resource('stuff', StuffController::class);

    // Roles Route
    Route::resource('roles', RoleController::class);

    // System
    Route::view('/server-status', 'backend.system.server_status')->name('system_server');
});

// Add this to your web.php for testing purposes
Route::get('/livewire-components', function () {
    return response()->json(\Livewire\Livewire::getComponentNames());
});
