<?php 

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\auth\AdminAuthController;

Route::get('/', function() {
    return redirect('/admin/dashboard');
});

Route::get('/login', [AdminAuthController::class, 'form'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');

Route::middleware('admin.auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});
