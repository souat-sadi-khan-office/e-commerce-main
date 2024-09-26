<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'avatar',
        'allow_changes',
        'last_seen',
        'last_login',
        'address',
        'area',
        'city',
        'country',
        'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getAuthIdentifier()
    {
        return $this->getKey(); // Usually the ID of the Admin
    }

    public function getAuthPassword()
    {
        return $this->password; // Return the password attribute
    }

    public function getRememberToken()
    {
        return $this->remember_token; // Return the remember token
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value; // Set the remember token
    }

    public function getRememberTokenName()
    {
        return 'remember_token'; // Specify the remember token column name
    }

    public function getAuthIdentifierName()
    {
        return 'id'; // The identifier column name, usually 'id'
    }
}
