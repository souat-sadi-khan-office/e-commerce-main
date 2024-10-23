<?php

namespace App\Repositories;

use App\CPU\paypal;
use App\Models\City;
use App\Models\Order;
use App\Models\Country;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Repositories\Interface\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function index($request)
    {
        return 1;
    }
    public function store($request)
    {
        // Step 1: Validate and Modify Data 
        $this->validateRequest($request);
        $getProductsData = $this->productsdata($request['product'], $request['country_id'], $request['shipping_city'] ?? $request['billing_city']);

        $productIds = $getProductsData->pluck('id')->toArray();
        $details['products'] = $getProductsData->map(function ($item) {
            return [
                'id' => $item['id'],
                'stock_id' => $item['stock']->id,
                'name' => $item['name'],
                'qty' => $item['order_qty'],
                'slug' => $item['slug'],
                'total_price' => $item['unit_price'] * $item['order_qty'],
                'unit_price' => $item['unit_price'],
                'discount' => $item['discount'],
                'discount_type' => $item['discount_type'],
            ];
        })->toArray();

        $details['company_name'] = $request['customer_company'];
        $details['user_name'] = $request['customer_name'];

        $billingAddress = $this->generateAddress($request, 'billing');
        $shippingAddress = isset($request['different_shipping_address'])
            ? $this->generateAddress($request, 'shipping')
            : $billingAddress;

        try {
            DB::beginTransaction();

            // Step 2: Create the order
            $order = Order::create([
                'unique_id' => uniqid('#'),
                'payment_id' => null,
                'user_id' => Auth::guard('customer')->user()->id,
                'order_amount' => $request['subtotal'] + $request['discount'],
                'tax_amount' => $request['total_tax'],
                'discount_amount' => $request['discount'],
                'final_amount' => $request['subtotal'],
                'currency_id' => Session::get('currency_id') ?? Auth::guard('customer')->user()->currency_id,
                'payment_status' => 'Not_Paid',
                'status' => 'pending',
                'is_delivered' => false,
                'is_cod' => $request['payment_option'] === 'cash_on_delivery',
                'is_refund_requested' => false,
            ]);

            // Step 4: Create the order details
            OrderDetail::create([
                'order_id' => $order->id,
                'product_ids' => json_encode($productIds),
                'details' => json_encode($details),
                'notes' => $request['notes'] ?? null,
                'shipping_method' => $request['shipping_method'] ?? 'Default',
                'shipping_address' => $shippingAddress,
                'billing_address' => $billingAddress,
                'phone' => $request['customer_phone'],
                'email' => $request['customer_email'],
            ]);

            // // Step 5: Adjust Stock for Paid Orders
            // if(!$order->is_cod){
            //     $this->adjustStock($getProductsData);
            // }


            DB::commit();
            // Return success response
            return [
                'status' => true,
                'order' => $order,
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    private function adjustStock($productsData)
    {
        foreach ($productsData as $product) {
            $stockItem = $product['stock'];
            if ($stockItem) {
                $this->updateStock($stockItem, $product['order_qty']);
            }
        }
    }

    private function updateStock($stockItem, $quantity)
    {
        $newStock = $stockItem->stock - $quantity;

        $stockItem->update(['stock' => $newStock]);
    }


    private function validateRequest($request)
    {
        try {
            $request->validate([
                'customer_name' => 'required',
                'customer_email' => 'required|email',
                'customer_phone' => 'required',
                'customer_company' => 'required',
                'billing_city' => 'required|exists:cities,id',
                'billing_area' => 'required',
                'billing_address' => 'required',
                'billing_address2' => 'required',
                'product' => 'required|array',
                'shipping_charge' => 'required|numeric',
                'total_tax' => 'required|numeric',
                'discount' => 'required|numeric',
                'subtotal' => 'required|numeric',
                'payment_option' => 'required',
                'currency_code' => 'required|exists:currencies,code',
            ]);

            if ($request->filled('different_shipping_address')) {
                $request->validate([
                    'shipping_city' => 'required',
                    'shipping_area' => 'required',
                    'shipping_address' => 'required',
                ]);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('order.checkout')
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    private function productsdata($products, $countryId, $cityId)
    {
        return collect($products)->map(function ($product) use ($countryId, $cityId) {
            $item = Product::where('slug', $product['slug'])
                ->select('id', 'slug', 'name', 'unit_price', 'discount', 'discount_type', 'sku', 'stock_types')
                ->with(['stock' => function ($query) {
                    $query->select('id', 'stock', 'number_of_sale', 'in_stock', 'product_id')
                        ->where('in_stock', '>', 0);
                }])
                ->first();
            if ($item) {
                if ($item->stock_types === 'globally') {
                    $stockItem = $item->stock->first();
                } else {
                    $stockItem = $item->stock->filter(function ($stock) use ($countryId, $cityId) {
                        if ($countryId && $stock->country_id == $countryId) {
                            return true;
                        }
                        if ($cityId && $stock->city_id == $cityId) {
                            return true;
                        }
                        if (!$cityId) {
                            $country = Country::find($countryId);
                            if ($country && $stock->zone_id == $country->zone_id) {
                                return true;
                            }
                        }
                        return false;
                    })->first();
                }

                if ($stockItem) {
                    return [
                        'id' => $item->id,
                        'slug' => $item->slug,
                        'name' => $item->name,
                        'unit_price' => $item->unit_price,
                        'discount' => $item->discount,
                        'discount_type' => $item->discount_type,
                        'sku' => $item->sku,
                        'stock' => $stockItem,
                        'order_qty' => $product['qty'],
                    ];
                }
            }

            return null;
        })->filter();
    }


    private function generateAddress($request, string $type)
    {
        $address = $request["{$type}_address"];

        if (isset($request["{$type}_address2"])) {
            $address .= ', ' . $request["{$type}_address2"];
        }

        $address .= ', ' . $request["{$type}_area"];

        $cityName = City::find($request["{$type}_city"])->name ?? '';
        if ($cityName) {
            $address .= ', ' . $cityName;
        }

        $countryName = $request['country_name'] ?? '';
        if ($countryName) {
            $address .= ', ' . $countryName;
        }

        return $address;
    }
}
