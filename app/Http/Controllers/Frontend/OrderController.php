<?php

namespace App\Http\Controllers\Frontend;

use App\CPU\paypal;
use App\Models\City;
use App\Models\Order;
use App\Models\Country;
use App\Models\Payment;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductStock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\Interface\OrderRepositoryInterface;

class OrderController extends Controller
{
    private $orderRepository;
    private $userRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        UserRepositoryInterface $userRepository,
    ) {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
    }

    public function checkout(Request $request)
    {

        $countryName = Session::get('user_country');
        $country = Country::where('name', $countryName)->with(['city' => function ($query) {
            $query->where('status', 1)->select('id', 'name', 'country_id');
        }])->first();
        $countryID = $country->id;
        $cities = $country->city;
        $userInfo = $this->userRepository->informations($countryID);

        // dd($userInfo);

        return view('frontend.order.checkout', compact('userInfo', 'countryID', 'countryName', 'cities'));
    }

    public function store(Request $request)
    {
        if (!isset($request->token) && !isset($request->PayerID)) {

            $order = $this->orderRepository->store($request);
            if ($order['order']->is_cod) {
                return redirect()->route('home');
            }
        }
        if ($request->payment_option == 'paypal' && $order['order']->id) {
            $payment = paypal::processPayment($request->currency_code, $request->subtotal, $order['order']->unique_id);
        }

        if (isset($payment['approval_url'])) {
            return redirect($payment['approval_url']);
        }

        if (isset($request->token) && isset($request->PayerID)) {
            $capture = paypal::capturePayment($request->token);
            $capture_contents = json_decode($capture->getContent());

            if (isset($capture_contents->details->status) && $capture_contents->details->status === 'COMPLETED') {
                // Update payment information
                $pay = Payment::where('payment_order_id', $capture_contents->details->id)->first();

                if ($pay) {
                    $pay->update([
                        'email' => $capture_contents->details->payer->email_address,
                        'payer_id' => $capture_contents->details->payer->payer_id,
                        'status' => $capture_contents->details->status,
                    ]);

                    // Update order status
                    $order = Order::with('details')->where('unique_id', $pay->payment_unique_id)->first();
                    $order->update([
                        'payment_id' => $pay->id,
                        'payment_status' => 'Paid',
                    ]);
                    $details = json_decode($order->details->details);
                    $this->adjustStock($details->products);

                    return redirect()->route('home');
                }
            } else {
                return redirect()->back()->with(['error' => json_decode($capture_contents->error)->details[0]->issue]);
            }
        }
        return redirect()->back()->with(['error' => 'Something Went Wrong!']);
    }

    public function address($id)
    {
        $address = UserAddress::find($id);
        if (!isset($address)) {
            return response()->json(['success' => false, 'massage' => 'Address Not Found']);
        }
        return response()->json(['success' => true, 'address' => $address]);
    }


    private function adjustStock($products)
    {
        foreach ($products as $product) {
            $stockId = $product->stock_id;
            $qty = (int) $product->qty;
            $stock = ProductStock::find($stockId);
            if ($stock) {
                if ($stock->stock >= $qty) {
                    $stock->stock -= $qty;
                    $stock->save();
                } else {
                    dd(132);
                }
            }
        }
    }
}
