<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\CPU\Helpers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\HomepageSettings;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Repositories\Interface\BannerRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;

class HomePageController extends Controller
{
    private $banner;
    private $product;
    public function __construct(
        BannerRepositoryInterface $banner,
        ProductRepositoryInterface $product
    ) {
        $this->banner = $banner;
        $this->product = $product;
    }
    public function visibility(Request $request, $section)
    {
        try {
            $validSections = [
                'bannerSection',
                'sliderSection',
                'midBanner',
                'dealOfTheDay',
                'trending',
                'brands',
                'popularANDfeatured',
                'newslatter',
            ];

            if (!in_array($section, $validSections)) {
                return response()->json(['error' => 'Invalid section provided.', 'success' => false]);
            }

            $settings = HomepageSettings::first();

            if ($settings) {
                $settings->$section = !$settings->$section;
                $settings->last_updated_by = Auth::guard('admin')->id();
                $settings->save();

                Session::put('homepage_setting.' . $section, $settings->$section);
                Session::put('homepage_setting.last_updated_by', Auth::guard('admin')->user()->name);
                Session::put('homepage_setting.last_updated_at', $settings->updated_at);

                return response()->json(['success' => true, 'message' => Str::upper($section) . ' Section status updated successfully.']);
            } else {
                return response()->json(['error' => 'Homepage settings not found.', 'success' => false]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'success' => false]);
        }
    }

    public function index(Request $request)
    {

        $banners = Cache::remember('banners', now()->addMinutes(300), function () {
            $data = $this->banner->getAllBanners();

            return $data->where('status', 1)
                ->groupBy('banner_type')
                ->filter(function ($group, $key) {
                    if ($key === 'main_sidebar' && $group->count() >= 2) {
                        return $group->shuffle()->take(2);
                    }
                    return $key !== 'main_sidebar' ? $group : collect();
                });
        });
        $n = isset($request->best_seller) ? 'best_seller' :
                (isset($request->featured) ? 'featured' :
                (isset($request->offred) ? 'offred' : ''));
        if ($request->ajax()) {
            $products = Cache::remember('homeProducts_' . $n, now()->addMinutes(10), function () use ($request) {
                return $this->product->index($request);
            });

            if (isset($request->best_seller)) {
                return view('frontend.homepage.sellers-tab', compact('products'));
            }elseif(isset($request->featured)) {
                return view('frontend.homepage.featured-tab', compact('products'));
            }elseif(isset($request->offred)) {
            return view('frontend.homepage.offred-tab', compact('products'));
            }
        }
          $newProducts = Cache::remember('newProducts', now()->addMinutes(10), function () {

            return $this->product->index(null);
        });

        // dd($newProducts);

        return view('frontend.homepage.index', compact('banners', 'newProducts'));
        // dd($banners);
    }
}

