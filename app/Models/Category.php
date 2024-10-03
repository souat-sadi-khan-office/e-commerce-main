<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'admin_id',
        'name',
        'slug',
        'photo',
        'icon',
        'header',
        'short_description',
        'description',
        'site_title',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'meta_article_tag',
        'meta_script_tag',
        'status',
        'is_featured',
    ];

    // Self-relation for parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Relation with Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    // Relation for subcategories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Relation for keys
    public function key() 
    {
        return $this->hasMany(SpecificationKey::class);
    }

    // Relation with product
    public function product()
    {
        return $this->hasMany(Product::class);
    }

    // Relation with banner
    public function banner()
    {
        return $this->hasMany(Banner::class);
    }
    public function specificationKeys()
    {
        return $this->hasMany(SpecificationKey::class);
    }
}
