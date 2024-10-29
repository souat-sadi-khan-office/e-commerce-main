<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaptopFinderBudget extends Model
{
    protected $fillable = [
        'name',
        'status',
        'created_by'
    ];

    // Relation with admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
