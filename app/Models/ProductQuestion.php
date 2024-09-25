<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'message',
    ];

    // Define relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relation with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation with answer
    public function answer()
    {
        return $this->belongsTo(ProductQuestionAnswer::class);
    }
}
