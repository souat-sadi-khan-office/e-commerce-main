<?php

namespace App\Http\Controllers\Admin;

use Mpdf\Mpdf;
use App\Models\Order;
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


    public function index(Request $request)
    {
        $orders = $this->orderRepository->index($request);
        if ($request->ajax()) {
            return $this->orderRepository->indexDatatable($orders);
        }

        $status = $request->status;
        $payment_status = $request->payment_status;
        $refund_requested = $request->refund_requested;
        return view('backend.order.index', compact('status', 'payment_status', 'refund_requested'));
    }

    public function details($id)
    {

        $order = $this->orderRepository->details($id);
        return view('backend.order.details', compact('order'));
        $data = encode($id);
        dd($data, decode($data));
    }
    public function invoice($id, Request $request)
    {
        $order = $this->orderRepository->details($id);

        $html = view('backend.order.invoice', compact('order'))->render();

        $mpdf = new Mpdf();

        $mpdf->WriteHTML($html);

        if ($request->has('download')) {
            return response()->streamDownload(function() use ($mpdf) {
                echo $mpdf->Output('', 'S');
            }, 'invoice_'.$order['unique_id'].'.pdf');
        } else {
            $mpdf->Output(); 
        }
    }

    public function updateStatus(Request $request, $orderId)
    {
        return $this->orderRepository->updateStatus($request,$orderId);
      
    }
}
