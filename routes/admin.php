<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', function() {
    return redirect()->route('admin.login');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login/post', [LoginController::class, 'login'])->name('login.post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['isAdmin', 'web'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    // System
    Route::view('/server-status', 'backend.system.server_status')->name('system_server');
});