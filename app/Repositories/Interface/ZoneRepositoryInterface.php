<?php

namespace App\Repositories\Interface;

interface ZoneRepositoryInterface
{
    public function getAllZone();
    public function findZoneById($id);
    public function createZone(array $data);
    public function updateZone($id, array $data);
    public function deleteZone($id);
    public function updateStatus($request, $id);
}
