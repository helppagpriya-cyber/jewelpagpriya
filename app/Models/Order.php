<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'shipped_date',
        'total_amount',
        'delivered_date',
        'is_express_delivery',
        'delivery_charges',
        'payment_mode',
        'payment_status',
        'user_address_id',
        'tracking_no',
        'payment_id',               // <-- NEW
        'payment_gateway_order_id', // <-- NEW
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    // -----------------------------------------------------------------
    // Relationships
    // -----------------------------------------------------------------
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

    // -----------------------------------------------------------------
    // Helper
    // -----------------------------------------------------------------
    public function markAsPaid(string $gatewayTxId): void
    {
        $this->update([
            'payment_status' => 'paid',
            'payment_id'     => $gatewayTxId,   // Razorpay payment_id
        ]);
    }
}
