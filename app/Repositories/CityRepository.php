<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\Interface\CityRepositoryInterface;

class CityRepository implements CityRepositoryInterface
{
    public function getAllCities()
    {
        return City::all();
    }

    public function findCityById($id)
    {
        return City::findOrFail($id);
    }

    public function createCity(array $data)
    {
        $city = City::create($data);

        return $city;
    }

    public function updateCity($id, array $data)
    {
        $city = City::findOrFail($id);
        $city->update($data);

        return $city;
    }

    public function deleteCity($id)
    {
        $city = City::findOrFail($id);
        return $city->delete();
    }
}