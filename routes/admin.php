<?php 

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\Backend\Auth\AdminAuthController;

Route::get('/', function() {
    return redirect('admin/dashboard');
});

Route::get('/login', [AdminAuthController::class, 'form'])->name('login');
Route::post('/login-check', [AdminAuthController::class, 'login'])->name('login.post');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['admins', 'verified'])->name('dashboard');



// Route::middleware(['auth:admins'])->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
// });