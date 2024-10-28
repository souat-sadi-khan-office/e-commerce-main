<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\Interface\OrderRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\CurrencyRepositoryInterface;

class UserController extends Controller
{
    private $user;
    private $currency;
    private $orderRepository;
    protected $productRepository;



    public function __construct(
        UserRepositoryInterface $user,
        CurrencyRepositoryInterface $currency,
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository,

    ) {
        $this->user = $user;
        $this->currency = $currency;
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    
    }

    public function index(Request $request)
    {
        $data=$this->orderRepository->userData();
        $models = $this->user->getUserWishList();
        return view('frontend.customer.dashboard',compact('data','models'));
    }
    
    public function myOrders()
    { 
        $models=$this->orderRepository->userOrders();
        return view('frontend.customer.my-orders',compact('models'));
    }
    public function orderDetails($id)
    {

        $order = $this->orderRepository->details(decode($id));
        return view('frontend.customer.my-order_details', compact('order'));
    }
    public function orderInvoice($id, Request $request)
    {
        $order = $this->orderRepository->details(decode($id));
        return view('backend.order.invoice', compact('order','request'));
    
    }
    
    public function quotes()
    { 
        $quotes=$this->productRepository->userQuotes();
        return view('frontend.customer.quotes',compact('quotes'));
    }
    
    public function profile()
    {
        $model = $this->user->getCustomerDetails();
        $currencies = $this->currency->getAllActiveCurrencies();

        return view('frontend.customer.profile', compact('model', 'currencies'));
    }

    public function updateProfile(Request $request)
    {
        return $this->user->updateProfile($request);
    }
    
    public function password()
    {
        return view('frontend.customer.password');
    }

    public function updatePassword(Request $request) 
    {
        return $this->user->updatePassword($request);
    }
    
    public function addressBook()
    {
        return view('frontend.customer.address');
    }
    
    public function wishlist()
    {
        $models = $this->user->getUserWishList();
        return view('frontend.customer.wishlist', compact('models'));
    }

    public function destroyWishlist($id)
    {
        return $this->user->removeWishList($id);
    }
    
    public function star_points()
    {
        return view('frontend.customer.star_points');
    }

    public function saved_pc()
    {
        return view('frontend.customer.saved_pc');
    }

    public function transactions()
    {
        return view('frontend.customer.transactions');
    }
}
