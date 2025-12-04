<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendorOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_no',
        'user_id',
        'status',
        'order_date',
        'sub_total',
        'metal_value',
        'making_total',
        'discount',
        'taxable_value',
        'cgst',
        'sgst',
        'igst',
        'total_amount',
        'paid_amount',
        'balance_amount',
        'notes',
        'created_by'
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(VendorOrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(VendorPayment::class);
    }

    // public function recalculateTotals()
    // {
    //     $items = $this->items;
    //     $metal = $items->sum('item_metal_value');
    //     $making = $items->sum('making_charges');
    //     $sub = $items->sum('item_total'); // alternative
    //     // apply discount logic if any
    //     $taxable = max(0, $metal + $making - $this->discount);
    //     // GST calculation handled below by Business Logic (see Price formula)
    //     // set fields and save
    // }
}
