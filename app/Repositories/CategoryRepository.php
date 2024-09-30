<?php

namespace App\Repositories;

use App\CPU\Helpers;
use App\CPU\Images;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interface\CategoryRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function index($request)
    {
        if($request->has('sub')){

        }else{

            return Category::where('parent_id',null)->select('id','name','photo','icon','admin_id','status','is_featured')->get();
        }
        
    }

    public function store($data)
    {

        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'icon' => 'required|string',
            'header' => 'required|string|max:255',
            'short_description' => 'required|string',
            'site_title' => 'required|string|max:255',
            'description' => 'required|string',
            'meta_title' => 'required|string|max:255',
            'meta_keyword' => 'required|string',
            'meta_description' => 'required|string',
            'meta_article_tag' => 'nullable|string',
            'meta_script_tag' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'status' => false,'validator'=>true, 'message' => $validator->errors()]);
        }
        try {

            $category = Category::create([
                'name' => $data->name,
                'admin_id' => Auth::guard('admin')->id(),
                'parent_id' => $data->parent_id,
                'slug' => $data->slug,
                'icon' => Helpers::icon($data->icon),
                'header' => $data->header,
                'short_description' => $data->short_description,
                'site_title' => $data->site_title,
                'description' => $data->description,
                'meta_title' => $data->meta_title,
                'meta_keyword' => $data->meta_keyword,
                'meta_description' => $data->meta_description,
                'meta_article_tag' => $data->meta_article_tag,
                'meta_script_tag' => $data->meta_script_tag,
                'status' => isset($data->status),
                'is_featured' => isset($data->is_featured),
                'photo' => $data->photo ? Images::upload('categories', $data->photo) : null,
            ]);

            return response()->json(['message' => 'Created successfully!', 'status' => true,'load'=>true]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'status' => false]);
        }
    }

    public function checkSlugExists(string $slug): bool
    {
        return Category::where('slug', $slug)->exists();
    }
    public function categoriesDropDown()
    {
        return Category::select('id','name')->get();
    }

    public function updateisFeatured($request, $id)
    {
         $request->validate([
            'is_featured' => 'required|boolean', // Ensure it's a boolean value
        ]);

        $category = Category::find($id);
        
        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Category not found.'], 404);
        }

        $category->is_featured = $request->input('is_featured');
        $category->save();

        return response()->json(['success' => true, 'message' => 'Category status updated successfully.']);
    }
    public function updatestatus($request, $id)
    {
         $request->validate([
            'status' => 'required|boolean', // Ensure it's a boolean value
        ]);

        $category = Category::find($id);
        
        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Category not found.'], 404);
        }

        $category->is_featured = $request->input('status');
        $category->save();

        return response()->json(['success' => true, 'message' => 'Category status updated successfully.']);
    }
}
