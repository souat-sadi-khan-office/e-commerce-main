<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use Carbon\Carbon;
use App\CPU\Helpers;
use App\Models\Rating;
use App\Models\Country;
use App\Models\Product;
use App\Models\Currency;
use App\Models\Category;
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
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\ProductStock;
use App\Repositories\Interface\BannerRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\FlashDealRepositoryInterface;
use App\Repositories\Interface\BrandRepositoryInterface;

class HomePageController extends Controller
{
    private $banner;
    private $brands;
    private $product;
    private $flashDeals;
    public function __construct(
        BannerRepositoryInterface $banner,
        ProductRepositoryInterface $product,
        BrandRepositoryInterface $brands,
        FlashDealRepositoryInterface $flashDeals,
    ) {
        $this->brands = $brands;
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

    public function cart(Request $request) 
    {
        $items = [];
        $counter = 0;
        $total_price = 0;

        // Check if customer is logged in
        if(Auth::guard('customer')->check()) {
            $cart = Cart::where('user_id', Auth::guard('customer')->user()->id)->first();
        } else {
            // Otherwise, check for cart using IP address
            $cart = Cart::where('ip', $request->ip())->first();
        }

        // If cart exists, get the cart details
        if($cart) {
            $items = CartDetail::where('cart_id', $cart->id)->get();
            $counter = count($items);
            $total_price = $cart->total_price;
        }

        return view('frontend.cart', compact('items', 'cart'));
    }

    public function addQtyToCart(Request $request) 
    {
        $id = $request->id;
        $cart_total_amount = 0;
        $cart_sub_total_amount = 0;
        $item_sub_total = 0;
        
        if(!$id) {
            return response()->json(['status' => false, 'message' => 'Cart item not found. ']);
        }

        $item = CartDetail::find($id);
        if(!$item) {
            return response()->json(['status' => false, 'message' => 'Cart item not found. ']);
        }
        $cartId = $item->cart_id;

        $cart = Cart::find($cartId);
        if(!$cart) {
            return response()->json(['status' => false, 'message' => 'Cart item not found. ']);
        }

        // getting this product stock
        $this->productStock($item->product_id, ($item->quantity + 1));

        $item->quantity = $item->quantity + 1;
        $item->save();

        $item_sub_total = format_price(convert_price($item->quantity * $item->price));

        $items = CartDetail::where('cart_id', $cartId)->get();
        $total_quantity = 0;
        $total_price = 0;
        if($items) {
            foreach($items as $item) {
                $total_quantity += $item->quantity;
                $total_price += ($item->quantity * $item->price);
            }
        }

        $cart = Cart::find($cartId);
        if($cart) {
            $cart->total_price = $total_price;
            $cart->total_quantity = $total_quantity;
            $cart->save();

            $items = CartDetail::where('cart_id', $cart->id)->get();
            $counter = count($items);
            $total_price = $cart->total_price;
            $cart_total_amount = format_price(convert_price($total_price));
            $cart_sub_total_amount = format_price(convert_price($total_price));
        }

        // Return view with cart items
        return response()->json([
            'status' => true, 
            'message' => 'Cart is updated', 
            'id' => $id,
            'item_sub_total' => $item_sub_total,
            'cart_sub_total_amount' => $cart_sub_total_amount, 
            'cart_total_amount' => $cart_total_amount
        ]);
    }

    public function productStock($productId, $numberOfQty)
    {
        $product = Product::find($productId);
        if(!$product) {
            return response()->json(['status' => false, 'message' => 'Product not found.']);
        }

        dd($product->in_stock);
        if($product->in_stock == 0) {
            return response()->json(['status' => false, 'message' => 'Product is out of stock.']);
        }

        if($product->details->current_stock < $numberOfQty) {

        }

        switch($product->stock_types) {
            case 'globally':
                $stock = ProductStock::where('product_id', $productId)->first();
                if(!$stock) {
                    return response()->json(['status' => false, 'message' => 'Product stock not found.']);
                }
            break;
        }
    }

    public function getCartItems(Request $request) 
    {
        $items = [];
        $counter = 0;
        $total_price = 0;

        // Check if customer is logged in
        if(Auth::guard('customer')->check()) {
            $cart = Cart::where('user_id', Auth::guard('customer')->user()->id)->first();
        } else {
            // Otherwise, check for cart using IP address
            $cart = Cart::where('ip', $request->ip())->first();
        }

        // If cart exists, get the cart details
        if($cart) {
            $items = CartDetail::where('cart_id', $cart->id)->get();
            $counter = count($items);
            $total_price = $cart->total_price;
        }

        // Return view with cart items
        if($request->has('show') && $request->show == 'main-cart-area') {
            $html = view('frontend.components.main_cart_listing', compact('items'))->render();
        } else {
            $html = view('frontend.components.cart_listing', compact('items'))->render();
        }
        return response()->json(['content' => $html, 'total_price' => $total_price, 'counter' => $counter]);
    }

    public function removeCartItems(Request $request)
    {
        $id = $request->id;
        
        if(!$id) {
            return response()->json(['status' => false, 'message' => 'Cart item not found. ']);
        }

        $item = CartDetail::find($id);
        if(!$item) {
            return response()->json(['status' => false, 'message' => 'Cart item not found. ']);
        }
        $cartId = $item->cart_id;

        $cart = Cart::find($cartId);
        if(!$cart) {
            return response()->json(['status' => false, 'message' => 'Cart item not found. ']);
        }

        $item->delete();

        $items = CartDetail::where('cart_id', $cartId)->get();
        $total_quantity = 0;
        $total_price = 0;

        if($items) {
            foreach($items as $item) {
                $total_quantity += $item->quantity;
                $total_price += $item->price;
            }
        }

        $cart = Cart::find($cartId);
        if($cart) {
            $cart->total_price = $total_price;
            $cart->total_quantity = $total_quantity;
            $cart->save();

            $items = CartDetail::where('cart_id', $cart->id)->get();
            $counter = count($items);
            $total_price = $cart->total_price;
        }

        // Return view with cart items
        if($request->has('show') && $request->show == 'main-cart-area') {
            $html = view('frontend.components.main_cart_listing', compact('items'))->render();
        } else {
            $html = view('frontend.components.cart_listing', compact('items'))->render();
        }
        return response()->json(['status' => true, 'message' => 'Item is removed', 'content' => $html, 'total_price' => $total_price, 'counter' => $counter]);
    }

    public function addToCart(Request $request)
    {
        $sku = $request->slug;

        $product = Product::where('sku', $sku)->first();
        if(!$product) {
            return response()->json([
                'status' => false,
                'message' => "Product not Found"
            ]);
        }

        // Find or create a cart for the user or by IP address
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::guard('customer')->user()->id ?? null, 'ip' => $request->ip()],
            ['total_price' => 0, 'total_quantity' => 0, 'currency_id' => 1]
        );

        // Check if the product already exists in the cart
        $cartDetail = CartDetail::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        // If the product exists in the cart, update quantity
        if ($cartDetail) {
            $cartDetail->quantity += $request->quantity;
            $cartDetail->price += $product->unit_price * $request->quantity;
        } else {
            // Otherwise, create a new cart detail
            $cartDetail = new CartDetail([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'price' => $product->unit_price,
                'quantity' => $request->quantity,
                'promo_applied' => 0,
                'discount' => 0
            ]);
        }
        $cartDetail->save();

        // Update cart total price and quantity
        $cart->total_price += $product->unit_price * $request->quantity;
        $cart->total_quantity += $request->quantity;
        $cart->save();

        return response()->json([
            'status' => true,
            'message' => 'Product added to cart successfully',
            'thumb_image' => asset($product->thumb_image),
            'name' => $product->name,
            'total_price' => $cart->total_price,
            'total_quantity' => $cart->total_quantity
        ]);
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
            } elseif (isset($request->brands)) {

                $brands = Cache::remember('brands_', (36000 * 10), function () use ($request) {
                    return $this->brands->getAllBrands()->select('slug', 'logo', 'name', 'status')->where('status', 1);
                });

                return view('frontend.homepage.brands-tab', compact('brands'));
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

        // For Currency
        $request->session()->put('currency_id', $currency->id);
        $request->session()->put('currency_code', $currency->code);
        $request->session()->put('currency_symbol', $currency->symbol);
        $request->session()->put('currency_exchange_rate', $currency->exchange_rate);

        // for country
        $request->session()->put('user_country', $country->name);
        $request->session()->put('country_flag', asset($country->image));

        session()->flash('success', 'Country changed to '. $country->name . ' and Currency changed to '. $currency->name);

    }

    public function allCategories()
    {
        $categories = Category::where('status', 1)->where('parent_id', null)->orderBy('name', 'ASC')->get();
        return view('frontend.categories', compact('categories'));
    }
    
    public function allBrands()
    {
        $brands = $this->brands
                    ->getAllBrands()
                    ->where('status', 1);

        return view('frontend.brands', compact('brands'));
    }
}
