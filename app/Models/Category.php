<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'image',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function updateChildCategoriesStatus()
    {
        // Only update children if the status is 0 or 1
        if ($this->status === 1) {
            $this->children->each(function ($child) {
                $child->update(['status' => $this->status]);
            });
        }
    }


    protected static function boot()
    {
        parent::boot();

        static::saved(function ($category) {
            $category->updateChildCategoriesStatus();
        });
    }

}
