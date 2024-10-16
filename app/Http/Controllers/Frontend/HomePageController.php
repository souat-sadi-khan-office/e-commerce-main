<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use Carbon\Carbon;
use App\CPU\Helpers;
use App\Models\Rating;
use App\Models\Country;
use App\Models\Product;
use App\Models\Currency;
use App\Models\WishList;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Models\ProductQuestion;
use App\Models\HomepageSettings;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductQuestion;
use App\Models\Rating;
use App\Models\WishList;
use App\Models\Country;
use App\Models\Currency;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interface\BannerRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\FlashDealRepositoryInterface;

class HomePageController extends Controller
{
    private $banner;
    private $product;
    private $flashDeals;
    public function __construct(
        BannerRepositoryInterface $banner,
        ProductRepositoryInterface $product,
        FlashDealRepositoryInterface $flashDeals,
    ) {
        $this->banner = $banner;
        $this->product = $product;
        $this->flashDeals = $flashDeals;
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


        $n = isset($request->best_seller) ? 'best_seller' : (isset($request->featured) ? 'featured' : (isset($request->offred) ? 'offred' : ''));


        if ($request->ajax()) {
            $products = Cache::remember('homeProducts_' . $n, now()->addMinutes(10), function () use ($request) {
                return $this->product->index($request);
            });

            if (isset($request->best_seller)) {
                return view('frontend.homepage.sellers-tab', compact('products'));
            } elseif (isset($request->featured)) {
                return view('frontend.homepage.featured-tab', compact('products'));
            } elseif (isset($request->offred)) {
                return view('frontend.homepage.offred-tab', compact('products'));
            }



            if (isset($request->mid_banners)) {
                $midBanners = Cache::remember('mid_banners', now()->addMinutes(300), function () {
                    $data = $this->banner->getAllBanners();

                    return $data->where('status', 1)
                        ->groupBy('banner_type')
                        ->filter(function ($group, $key) {
                            if ($key === 'mid' && $group->count() >= 3) {
                                return $group->shuffle()->take(3);
                            }
                        });
                });

                return response()->json(['success' => true, 'data' => $midBanners]);
            }


            // Not Implemented Yet
            if (isset($request->flash_deals)) {
                $flashDeals = $this->flashDeals();
                return response()->json([
                    'success' => true,
                    'data' => $flashDeals
                ]);
            }
        }

        $newProducts = Cache::remember('newProducts', now()->addMinutes(10), function () {

            return $this->product->index(null);
        });


        return view('frontend.homepage.index', compact('banners', 'newProducts'));
    }

    public function quickview($slug)
    {
        $product = Cache::remember($slug, now()->addMinutes(10), function () use ($slug) {
            return $this->product->quickview($slug);
        });
        return view('frontend.modals.quick-view', compact('product'));
    }

    private function flashDeals()
    {

        return Cache::remember('flashDeals', now()->addMinutes(2), function () {

            $deals = $this->flashDeals->getAllDeals();

            $now = Carbon::now();

            if ($deals->isNotEmpty()) {
                return $deals->filter(function ($deal) use ($now) {
                    if ($deal->status != 1 || $deal->type->isEmpty()) {
                        return false;
                    }

                    $startingTime = get_system_date($deal->starting_time);
                    $endTime = null;

                    // Calculate end time based on deadline_type
                    switch ($deal->deadline_type) {
                        case 'day':
                            $endTime = Carbon::parse($startingTime)->addDays($deal->deadline_time);
                            break;
                        case 'hour':
                            $endTime = Carbon::parse($startingTime)->addHours($deal->deadline_time);
                            break;
                        case 'minute':
                            $endTime = Carbon::parse($startingTime)->addMinutes($deal->deadline_time);
                            break;
                        case 'week':
                            $endTime = Carbon::parse($startingTime)->addWeeks($deal->deadline_time);
                            break;
                        case 'month':
                            $endTime = Carbon::parse($startingTime)->addMonths($deal->deadline_time);
                            break;
                        default:
                            break;
                    }

                    $deal->end_time = $endTime ? $endTime->toDateTimeString() : null;

                    return $endTime && $endTime->isFuture();
                })->map(function ($deal) {

                    $dealTypes = $deal->type()->select('id', 'product_id')->get();

                    $productDetails = $dealTypes->map(function ($type) {
                        return $type->productDetails()->select('id','current_stock', 'number_of_sale')->first();
                    });

                    $deal->starting_time = get_system_date($deal->starting_time);
                    $deal->product_details = $productDetails;

                    return [
                        'id' => $deal->id,
                        'title' => $deal->title,
                        'slug' => $deal->slug,
                        'image' => $deal->image,
                        'starting_time' => $deal->starting_time,
                        'end_time' => $deal->end_time,
                        'product_details' => $productDetails
                    ]; // Return the filtered deal
                });
            }
        });
    }

    public function submitQuestionForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'product' => 'nullable|string',
            'message' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::where('slug', $request->product)->where('status', 1)->first();
        if(!$product) {
            return response()->json(['status' => false, 'message' => 'Product not found']);
        }

        ProductQuestion::create([
            'product_id' => $product->id,
            'user_id' => Auth::guard('customer')->check() ? Auth::guard('customer')->user()->id : null,
            'name' => $request->name,
            'message' => $request->message 
        ]);

        return response()->json(['status' => true, 'message' => 'Question Submitted Successfully', 'load' => true]);
    }
    
    public function submitReviewForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|numeric',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'product' => 'nullable|string',
            'message' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if($request->rating < 1) {
            return response()->json(['status' => false, 'message' => 'Please add a rating first.']);
        }

        $product = Product::where('slug', $request->product)->where('status', 1)->first();
        if(!$product) {
            return response()->json(['status' => false, 'message' => 'Product not found']);
        }

        // add to rating table
        $rating = Rating::create([
            'product_id' => $product->id,
            'user_id' => Auth::guard('customer')->check() ? Auth::guard('customer')->user()->id : null,
            'name' => $request->name,
            'email' => $request->email,
            'rating' => $request->rating,
            'review' => $request->message 
        ]);
        
        if($rating) {
            $numberOfRating = Rating::where('product_id', $product->id)->count();
            $newNumberOfRating = $numberOfRating;

            $averageRating = (Rating::where('product_id', $product->id)->sum('rating') / $numberOfRating);

            $details = ProductDetail::where('product_id', $product->id)->first();
            $details->number_of_rating = $newNumberOfRating;
            $details->average_rating = $averageRating;
            $details->save();
        }

        return response()->json(['status' => true, 'message' => 'Review Submitted Successfully', 'load' => true]);
    }

    public function addToCompareList(Request $request)
    {
        $productId = $request->id;
        $compareList = session()->get('compare_list', []);

        if (!in_array($productId, $compareList)) {
            $compareList[] = $productId;
        } else {
            return response()->json([
                'status' => false,
                'message' => 'This product is already added to your compare list.',
            ]);
        }

        if(count($compareList) > 3) {
            return response()->json([
                'status' => false,
                'message' => 'You can not add more then 3 product at a time.',
            ]);
        }

        session()->put('compare_list', $compareList);

        $counter = count($compareList);

        return response()->json([
            'status' => true,
            'counter' => $counter,
            'message' => 'Product added to compare list successfully.',
        ]);
    }

    public function addToWishList(Request $request)
    {
        $productId = $request->id;

        if(!Auth::guard('customer')->check()) {
            return response()->json(['status' => false, 'message' => 'You must login or create an account to save products on your wishlist.']);
        }

        $userId = Auth::guard('customer')->user()->id;

        if(WishList::where('user_id', $userId)->where('product_id', $productId)->first()) {
            return response()->json(['status' => false, 'message' => 'This product is already added to your wishlist.']);
        }
        
        WishList::create([
            'user_id' => $userId,
            'product_id' => $productId
        ]);

        return response()->json(['status' => true, 'message' => 'Successfully added to your Wishlist.']);
    }

    public function currencyChange(Request $request)
    {
        $country = Country::find($request->global_country_id);
        $currency = Currency::find($request->global_currency_id);
        $request->session()->put('currency_id', $currency->id);
        $request->session()->put('currency_code', $currency->code);
        $request->session()->put('currency_symbol', $currency->symbol);
        $request->session()->put('currency_exchange_rate', $currency->exchange_rate);
        $request->session()->put('country_id', $country->id);
        $request->session()->put('country_name', $country->name);
        $request->session()->put('country_flag', asset($country->image));

        session()->flash('success', 'Country changed to '. $country->name . ' and Currency changed to '. $currency->name);

    }
}
