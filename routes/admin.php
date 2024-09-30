<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HelperController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\Admin\StuffController;

Route::get('/', function() {
    return redirect()->route('admin.login');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login/post', [LoginController::class, 'login'])->name('login.post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['isAdmin', 'web'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');



    Route::get('categories/add', [CategoryController::class, 'addform'])->name('category.add');
    Route::get('categories/sub/add', [CategoryController::class, 'addformsub'])->name('sub.category.add');
    Route::any('categories/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('categories', [CategoryController::class, 'index'])->name('category.index');
    Route::post('category/is/featured/{id}', [CategoryController::class, 'updateisFeatured'])->name('category.is_featured');
    Route::post('category/status/{id}', [CategoryController::class, 'updatestatus'])->name('category.status');
    Route::any('/slug-check', [HelperController::class, 'checkSlug'])->name('slug.check');

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
