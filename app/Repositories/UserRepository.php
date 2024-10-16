<?php

namespace App\Repositories;

use App\CPU\Images;
use App\Models\User;
use App\Models\WishList;
use App\Models\UserPhone;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interface\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function index($request)
    {
        $user = Auth::guard('customer')->user();
        return $user;
    }

    public function getUserWishList()
    {
        $userId = Auth::guard('customer')->id();
        return WishList::where('user_id', $userId)->orderBy('id', 'DESC')->get();
    }

    public function getCustomerDetails()
    {
        $userId = Auth::guard('customer')->id();
        return User::find($userId);
    }

    public function removeWishList($id)
    {
        $wishlist = WishList::find($id);
        
        if(!$wishlist) {
            return response()->json(['status' => false, 'message' => 'Product not found']);
        }

        $wishlist->delete();

        return response()->json(['status' => true, 'load' => true, 'message' => 'Item is removed from your wishlist']);
    }

    public function updateProfile($request)
    {
        $userId = Auth::guard('customer')->id();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'currency_id' => 'required',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::findOrFail($userId);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->currency_id = $request->currency_id;

        if ($request->avatar) {
            $user->avatar = Images::upload('users', $request->avatar);
        }

        $user->update();

        Auth::guard('customer')->setUser($user);

        return response()->json(['status' => true, 'load' => true, 'message' => 'Profile updated successfully.']);
    }

    public function updatePassword($request)
    {
        $userId = Auth::guard('customer')->id();
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::find($userId);
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['status' => false, 'load' => true, 'message' => 'Current password does not match.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['status' => true, 'load' => true, 'message' => 'Password updated successfully.']);
    }

    public function getUserPhoneList()
    {
        $userId = Auth::guard('customer')->user()->id;

        return UserPhone::where('user_id', $userId)->orderBy('id', 'DESC')->get();
    }
    
}