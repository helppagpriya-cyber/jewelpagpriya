<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendorpayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_order_id',
        'user_id',
        'amount',
        'payment_mode',
        'payment_date',
        'reference',
        'notes',
        'created_by'
    ];
    public function vendor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(VendorOrder::class, 'vendor_order_id');
    }
}
