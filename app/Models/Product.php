<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected  $fillable = [
        'metal_id',
        'category_id',
        'gemstone_id',
        'ocassion_id',
        'name',
        'slug',
        'description',
        'gender',
        'delivery_charge',
        'express_delivery_available',
        'express_delivery_charge',
        'warranty_period',
        'images',
        'certificate',
        'status'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function productDiscounts()
    {
        return $this->hasMany(ProductDiscount::class);
    }

    public function metal()
    {
        return $this->belongsTo(Metal::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function gemstone()
    {
        return $this->belongsTo(Gemstone::class);
    }
    public function occasion()
    {
        return $this->belongsTo(Occasion::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function review()
    {
        return $this->hasMany(Review::class);
    }
    public function getImageUrlAttribute($value)
    {
        return asset('storage/public/' . $value);
    }
}
