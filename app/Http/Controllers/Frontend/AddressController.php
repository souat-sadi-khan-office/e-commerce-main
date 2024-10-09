<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\Interface\ZoneRepositoryInterface;
use App\Repositories\Interface\CountryRepositoryInterface;
use App\Repositories\Interface\CityRepositoryInterface;
use App\Repositories\Interface\AddressControllerInterface;

class AddressController extends Controller
{

    private $user;
    private $zone;
    private $country;
    private $city;
    private $address;

    public function __construct(
        UserRepositoryInterface $user,
        ZoneRepositoryInterface $zone,
        CountryRepositoryInterface $country,
        CityRepositoryInterface $city,
        AddressControllerInterface $address 
    ) {
        $this->user = $user;
        $this->address = $address;
        $this->zone = $zone;
        $this->country = $country;
        $this->city = $city;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = $this->address->getAllByUser();
        return view('fontend.customer.address.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $zone = $this->zone->getAllActiveZones();
        return view('fontend.customer.address.create', compact('zone'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'zone_id'        => 'required',
            'country_id'     => 'required',
            'city_id'        => 'required',
            'area_id'        => 'required',
            'address'        => 'required',
            'postcode'       => 'required',
            'first_name'     => 'required|string|max:55',
            'last_name'      => 'required|string|max:55',
            'company_name'   => 'string|max:155',
            'address_line_2' => 'string',
            'is_default'     => 'required'
        ]);

        $this->address->createModel($data);

        return response()->json([
            'status' => true, 
            'goto' => route('account.address-book.index'),
            'message' => "New address is added successfully"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = $this->address->findModelById($id);
        return view('fontend.customer.address.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'zone_id'        => 'required',
            'country_id'     => 'required',
            'city_id'        => 'required',
            'area_id'        => 'required',
            'address'        => 'required',
            'postcode'       => 'required',
            'first_name'     => 'required|string|max:55',
            'last_name'      => 'required|string|max:55',
            'company_name'   => 'string|max:155',
            'address_line_2' => 'string',
            'is_default'     => 'required'
        ]);

        $this->address->updateModel($id, $data);

        return response()->json([
            'status' => true, 
            'goto' => route('account.address-book.index'),
            'message' => "Address information updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->address->deleteModel($id);

        return response()->json([
            'status' => true,
            'load' => true,
            'message' => "Address is deleted successfully"
        ]);
    }
}