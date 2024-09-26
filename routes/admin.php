<?php 

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\auth\AdminAuthController;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'form'])->name('login');
    Route::post('/loginn', [AdminAuthController::class, 'login'])->name('login.post');
    
    });

Route::middleware('auth:admins')->group(function () {
    
Route::get('/', function() {
    return view('backend.dashboard');
})->name('dashboard');
// Route::get('/dashboard', [AdminController::class, 'dashboard']);
});
