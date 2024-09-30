<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'admin_id',
        'category_id',
        'brand_id',
        'brand_type_id',
        'thumb_image',
        'unit_price',
        'status',
        'in_stock',
        'is_featured',
        'low_stock',
        'is_discounted',
        'discount_type',
        'discount',
        'discount_start_date',
        'discount_end_date',
        'is_returnable',
        'return_deadline',
    ];

    // Relationships
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    // Relation with category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relation with brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Relation with brand type
    public function brandType()
    {
        return $this->belongsTo(BrandType::class);
    }

    // Relation with product details
    public function details()
    {
        return $this->belongsTo(ProductDetail::class);
    }

    // Relation with product image
    public function image()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Relation with question
    public function question()
    {
        return $this->hasMany(ProductQuestion::class);
    }

    // Relation with stock
    public function stock()
    {
        return $this->hasMany(StockPurchase::class);
    }

    // Relation with banner
    public function banner()
    {
        return $this->hasMany(Banner::class);
    }

    // Relation with review
    public function review()
    {
        return $this->hasMany(Review::class);
    }
}