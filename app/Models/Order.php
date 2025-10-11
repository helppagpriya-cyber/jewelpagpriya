<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'shipped_date',
        'delivered_date',
        'is_express_delivery',
        'delivery_charges',
        'payment_mode',
        'payment_status',
        'user_address_id',
        'tracking_no'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function userAddress()
    {
        return $this->belongsTo(UserAddress::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function productSize()
    {
        return $this->belongsTo(ProductSize::class);
    }
    public function productDiscount()
    {
        return $this->belongsTo(ProductDiscount::class);
    }
}
