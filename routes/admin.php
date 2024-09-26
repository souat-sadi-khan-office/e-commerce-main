<?php 

use Illuminate\Support\Facades\Route;

Route::get('/hello', function() {
    return "hello World";
});

Route::middleware(['admin'])->group(function () {

});

