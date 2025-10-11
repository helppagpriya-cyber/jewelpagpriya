<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $fillable = [
        'product_id',
        'size',
        'stock',
        'metal_weight',
        'metal_purity',
        'metal_price',
        'gemstone_weight',
        'gemstone_purity',
        'gemstone_price',
        'num_of_gemstone',
        'making_charges',
        'gst'
    ];
}
