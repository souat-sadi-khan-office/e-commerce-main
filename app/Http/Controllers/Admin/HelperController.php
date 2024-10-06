<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Models\Brand;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Category;
use App\Models\FlashDeal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelperController extends Controller
{
    public function checkSlug(Request $request)
    {
        $slug = $request->get('slug');
        $id = $request->get('id');

        if (isset($id)) {
            // Using a single query with unions
            $exists = Category::where('slug', $slug)->where('id', '!=', $id)
                ->union(Product::where('slug', $slug)->where('id', '!=', $id))
                ->union(Offer::where('slug', $slug)->where('id', '!=', $id))
                ->union(Brand::where('slug', $slug)->where('id', '!=', $id))
                ->union(FlashDeal::where('slug', $slug)->where('id', '!=', $id))
                ->union(Page::where('slug', $slug)->where('id', '!=', $id))
                ->exists();
        } else {
            $exists = Category::where('slug', $slug)
                ->union(Product::where('slug', $slug))
                ->union(Offer::where('slug', $slug))
                ->union(Brand::where('slug', $slug))
                ->union(FlashDeal::where('slug', $slug))
                ->union(Page::where('slug', $slug))
                ->exists();
        }



        return response()->json(['exists' => $exists]);
    }

    // Test Function
    public function fatcher($slug, $index = 0)
    {
        $models = ['Category', 'Product'];

        if ($index >= count($models)) {
            return view('errors.404');
        }

        $model = $models[$index];

        $data = $model::where('slug', $slug)->first();

        if (!$data) {
            return $this->fatcher($slug, $index + 1);
        }

        // return $data;  to a view Based on Model
    }
}
