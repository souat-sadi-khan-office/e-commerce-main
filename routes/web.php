<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::post('search/category', [SearchController::class, 'searchByCategory'])->name('search.category');
