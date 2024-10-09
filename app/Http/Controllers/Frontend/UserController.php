<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\Interface\CurrencyRepositoryInterface;

class UserController extends Controller
{
    private $user;
    private $currency;

    public function __construct(
        UserRepositoryInterface $user,
        CurrencyRepositoryInterface $currency
    ) {
        $this->user = $user;
        $this->currency = $currency;
    }

    public function index(Request $request)
    {
        return view('fontend.customer.dashboard');
    }
    
    public function myOrders()
    {
        return view('fontend.customer.my-orders');
    }
    
    public function quotes()
    {
        return view('fontend.customer.quotes');
    }
    
    public function profile()
    {
        $model = $this->user->getCustomerDetails();
        $currencies = $this->currency->getAllActiveCurrencies();

        return view('fontend.customer.profile', compact('model', 'currencies'));
    }

    public function updateProfile(Request $request)
    {
        return $this->user->updateProfile($request);
    }
    
    public function password()
    {
        return view('fontend.customer.password');
    }

    public function updatePassword(Request $request) 
    {
        return $this->user->updatePassword($request);
    }
    
    public function addressBook()
    {
        return view('fontend.customer.address');
    }
    
    public function wishlist()
    {
        return view('fontend.customer.wishlist');
    }
    
    public function star_points()
    {
        return view('fontend.customer.star_points');
    }

    public function saved_pc()
    {
        return view('fontend.customer.saved_pc');
    }

    public function transactions()
    {
        return view('fontend.customer.transactions');
    }
}
