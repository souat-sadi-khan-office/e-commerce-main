<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\UserAddress;
use App\Repositories\Interface\OrderRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private $orderRepository;
    private $userRepository;
    private $product;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        UserRepositoryInterface $userRepository,
        ProductRepositoryInterface $product,
    ) {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->product = $product;
    }

    public function checkout(Request $request)
    {

        $request->country_id = 6;
        $userInfo = $this->userRepository->informations($request->country_id);
        $cities=City::where('country_id',$request->country_id)->where('status',1)->select('id','name')->get();

        // cart
        $items = [];
        $counter = 0;
        $total_price = 0;
        $tax_amount = 0;
        $models = [];
        
        if(Auth::guard('customer')->check()) {
            $cart = Cart::where('user_id', Auth::guard('customer')->user()->id)->first();
        } else {
            $cart = Cart::where('ip', $request->ip())->first();
        }

        if(!$cart) {
            $cart = Cart::firstOrCreate(
                ['user_id' => Auth::guard('customer')->user()->id ?? null, 'ip' => $request->ip()],
                ['total_quantity' => 0, 'currency_id' => 1]
            );
        }

        $items = CartDetail::where('cart_id', $cart->id)->get();

        $cart_updated = false;
        foreach($items as $item) {
            $stockResponse = getProductStock($item->product_id);
            if(!$stockResponse['status']) {
                $cart_updated = true;
                $itemQuantity = $item->quantity;
                $item->delete();
                $cart->total_quantity -= $itemQuantity;
                $cart->save();
            } else {
                $product_tax_amount = 0;
                $price = $this->product->discountPrice($item->product);
                $total_price += ($price * $item->quantity);

                if ($item->product->taxes->isNotEmpty()) {
                    foreach ($item->product->taxes as $tax) {
                        if ($tax->tax_type == 'percent') {
                            $product_tax_amount = (($item->product->unit_price * $tax->tax) / 100) * $tax->quantity;
                        } else {
                            $product_tax_amount = ($tax->tax * $item->quantity);
                        }
                    }

                    $tax_amount += $product_tax_amount;
                }

                $models[] = [
                    'id' => $item->id,
                    'slug' => $item->product->slug,
                    'name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $price,
                    'tax' => $product_tax_amount
                ];
            }
        }

        $total_price += $tax_amount;
        $shipping_charge = 10;
        $total_price += $shipping_charge;

        return view('frontend.order.checkout', compact('userInfo', 'shipping_charge', 'tax_amount', 'total_price', 'models', 'cities'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function address($id){
        $address=UserAddress::find($id);
        if(!isset($address)){
            return response()->json(['success'=>false,'massage'=>'Address Not Found']);
        }
        return response()->json(['success'=>true,'address'=>$address]);

    }
}
