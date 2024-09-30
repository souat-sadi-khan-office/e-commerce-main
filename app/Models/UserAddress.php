<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'zone_id',
        'country_id',
        'city_id',
        'area_id',
        'address',
        'postcode',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Zone
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    // Relationship with Country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Relationship with City
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Relationship with Area
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}