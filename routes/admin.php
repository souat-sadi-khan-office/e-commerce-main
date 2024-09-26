<?php 

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\auth\AdminAuthController;

Route::get('/login', [AdminAuthController::class, 'form'])->name('login');
Route::post('/login-check', [AdminAuthController::class, 'login'])->name('login.post');

Route::middleware(['admins'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
});