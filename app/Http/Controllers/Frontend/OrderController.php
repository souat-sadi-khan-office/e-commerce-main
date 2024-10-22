<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\UserAddress;
use App\Repositories\Interface\OrderRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


        $request->country_id = 6;
        $userInfo = $this->userRepository->informations($request->country_id);
        $cities=City::where('country_id',$request->country_id)->where('status',1)->select('id','name')->get();

        // dd($userInfo);

        return view('frontend.order.checkout', compact('userInfo','cities'));
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
