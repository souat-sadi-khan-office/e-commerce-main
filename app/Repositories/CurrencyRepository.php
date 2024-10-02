<?php

namespace App\Repositories;

use App\Models\Currency;
use App\Repositories\Interface\CurrencyRepositoryInterface;


class CurrencyRepository implements CurrencyRepositoryInterface
{
    public function getAllCurrencies()
    {
        return Currency::all();
    }

    public function findCurrencyById($id)
    {
        return Currency::findOrFail($id);
    }

    public function createCurrency(array $data)
    {
        $zone = Currency::create($data);

        return $zone;
    }

    public function updateCurrency($id, array $data)
    {
        $zone = Currency::findOrFail($id);
        $zone->update($data);

        return $zone;
    }

    public function deleteCurrency($id)
    {
        $role = Currency::findOrFail($id);
        return $role->delete();
    }    
}