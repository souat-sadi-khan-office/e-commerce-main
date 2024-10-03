<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // for searching categories
    public function searchByCategory(Request $request) 
    {
        if(!isset($request->searchTerm)){ 
            $json = [];
        } else {
            $search = $request->searchTerm;

            $categories = Category::where('name', $search)->get();

            $json = [];
            foreach($categories as $category) {
                $json[] = [
                    'id' => $category->id, 
                    'text' => $category->name 
                ];
            }
    
        }
        
        return response()->json($json);
    }
}
