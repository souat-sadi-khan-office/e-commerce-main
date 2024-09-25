<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $fillable = [
        'zone_id',
        'name',
        'status',
    ];

    // Relationship with Zone
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    // Relationship with City
    public function city()
    {
        return $this->hasMany(City::class);
    }
}
