<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\Interface\OrderRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;

class OrderController extends Controller
{
    private $orderRepository;
    private $userRepository;
    private $productRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        UserRepositoryInterface $userRepository,
        ProductRepositoryInterface $productRepository,
    ) {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
    }


    public function index(Request $request){
        $orders=$this->orderRepository->index($request);
        if ($request->ajax()) {
            return $this->orderRepository->indexDatatable($orders);
        }

        $status=$request->status;
        $payment_status=$request->payment_status;
        $refund_requested=$request->refund_requested;
        return view('backend.order.index', compact('status', 'payment_status','refund_requested'));

    }

    public function details($id){
        $data=encode($id);
        dd($data,decode($data));
    }
    public function invoice($id){
        dd($id);
    }

}
