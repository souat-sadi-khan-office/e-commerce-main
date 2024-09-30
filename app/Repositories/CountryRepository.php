<?php

namespace App\Repositories;

use App\Models\Country;
use App\Repositories\Interface\CountryRepositoryInterface;

class CountryRepository implements CountryRepositoryInterface
{
    public function getAllCountries()
    {
        return Country::all();
    }

    public function findCountryById($id)
    {
        return Country::findOrFail($id);
    }

    public function createCountry(array $data)
    {
        $country = Country::create($data);

        return $country;
    }

    public function updateCountry($id, array $data)
    {
        $country = Country::findOrFail($id);
        $country->update($data);

        return $country;
    }

    public function deleteCountry($id)
    {
        $country = Country::findOrFail($id);
        return $country->delete();
    }
}