<?php

namespace App\Repositories\Interface;

interface CurrencyRepositoryInterface
{
    public function getAllCurrencies();
    public function findCurrencyById($id);
    public function createCurrency(array $data);
    public function updateCurrency($id, array $data);
    public function deleteCurrency($id);
}