<?php

namespace App\Repositories\Interface;

interface CityRepositoryInterface
{
    public function getAllCities();
    public function findCityById($id);
    public function createCity(array $data);
    public function updateCity($id, array $data);
    public function deleteCity($id);
}
