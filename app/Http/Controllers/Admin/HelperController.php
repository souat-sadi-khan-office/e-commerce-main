<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelperController extends Controller
{
    public function checkSlug(Request $request)
    {
        $slug = $request->get('slug');
        $exists = Category::where('slug', $slug)->exists();
        
        return response()->json(['exists' => $exists]);
    }
    
}
