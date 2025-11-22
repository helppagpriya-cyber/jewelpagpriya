
<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    public function handleCallback(Request $request)
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $paymentId = $request->razorpay_payment_id;
        $orderId   = $request->razorpay_order_id;
        $signature = $request->razorpay_signature;

        try {
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $orderId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature'  => $signature,
            ]);

            $order = Order::where('payment_id', $orderId)->firstOrFail();
            $order->markAsPaid($paymentId);

            return redirect()->route('orders.show', $order)
                ->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            $order = Order::where('payment_id', $orderId)->first();
            if ($order) {
                $order->update(['payment_status' => 'failed']);
            }
            return redirect()->route('checkout')
                ->with('error', 'Payment failed.');
        }
    }
}
