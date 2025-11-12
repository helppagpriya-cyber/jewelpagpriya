<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;

class CheckoutPayment extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        abort_unless($order->user_id === Auth::id() && $order->payment_status === 'pending', 403);
        $this->order = $order->fresh();
    }

    public function payWithRazorpay()
    {
        $api = new \Razorpay\Api\Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );

        $rzOrder = $api->order->create([
            'amount'   => $this->order->total_amount * 100,
            'currency' => 'INR',
            'receipt'  => 'order_' . $this->order->id,
        ]);

        $this->order->update(['payment_gateway_order_id' => $rzOrder['id']]);

        // NO ->self() ! Let Livewire send the event
        $this->dispatch('openRazorpay', [
            'key'       => config('services.razorpay.key'),
            'amount'    => $this->order->total_amount * 100,
            'order_id'  => $rzOrder['id'],
            'name'      => Auth::user()->name,
            'email'     => Auth::user()->email,
        ]);
    }



    public function paymentSuccess($paymentId, $orderId, $signature)
    {
        if ($this->order->payment_gateway_order_id !== $orderId) {
            $this->dispatch('paymentFailed');
            return;
        }

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        try {
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $orderId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature'  => $signature,
            ]);

            $this->order->markAsPaid($paymentId);
            $this->dispatch('paymentCompleted');
        } catch (\Exception $e) {
            $this->order->update(['payment_status' => 'failed']);
            $this->dispatch('paymentFailed');
        }
    }

    public function render()
    {
        return view('livewire.checkout-payment');
    }
}
