<?php

namespace App\Repositories;

use App\Models\Zone;
use App\Repositories\Interface\ZoneRepositoryInterface;

class ZoneRepository implements ZoneRepositoryInterface
{
    public function getAllZone()
    {
        return Zone::all();
    }

    public function findZoneById($id)
    {
        return Zone::findOrFail($id);
    }

    public function createZone(array $data)
    {
        $zone = Zone::create($data);

        return $zone;
    }

    public function updateZone($id, array $data)
    {
        $zone = Zone::findOrFail($id);
        $zone->update($data);

        return $zone;
    }

    public function deleteZone($id)
    {
        $role = Zone::findOrFail($id);
        return $role->delete();
    }
}