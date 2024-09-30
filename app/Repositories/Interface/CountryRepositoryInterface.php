<?php

namespace App\Repositories\Interface;

interface CountryRepositoryInterface
{
    public function getAllCountries();
    public function findCountryById($id);
    public function createCountry(array $data);
    public function updateCountry($id, array $data);
    public function deleteCountry($id);
}