<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_order_id',
        'product_id',
        'name',
        'weight',
        'purity',
        'quantity',
        'rate_per_gram',
        'making_charges',
        'item_metal_value',
        'item_total'
    ];

    public function order()
    {
        return $this->belongsTo(VendorOrder::class, 'vendor_order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
