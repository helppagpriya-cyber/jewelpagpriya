<div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center mb-4">
        Complete Payment – Order #{{ $order->id }}
    </h2>

    <div class="text-center space-y-2 mb-6">
        <p class="text-lg"><strong>Total:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
        <p class="text-sm text-gray-600">Mode: ONLINE (Razorpay)</p>
    </div>

    <button
        wire:click="payWithRazorpay"
        wire:loading.attr="disabled"
        wire:loading.class="opacity-50"
        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition"
    >
        <span wire:loading.remove>Pay Now</span>
        <span wire:loading>Processing…</span>
    </button>

    <!-- Load Razorpay SDK ONCE -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    @if(session('error'))
        <div class="mt-4 p-3 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('openRazorpay', (payload) => {
            console.log('Razorpay Payload:', payload);

            // CRITICAL: Livewire wraps in array
            const data = Array.isArray(payload) ? payload[0] : payload;

            if (!data.key || !data.order_id || !data.amount) {
                alert('Invalid payment data. Contact support.');
                return;
            }

            const options = {
                key: data.key,
                amount: data.amount,
                currency: 'INR',
                name: 'Your Store',
                description: 'Order #{{ $order->id }}',
                order_id: data.order_id,
                handler: function (response) {
                    @this.call('paymentSuccess',
                        response.razorpay_payment_id,
                        response.razorpay_order_id,
                        response.razorpay_signature
                    );
                },
                prefill: {
                    name: data.name || '',
                    email: data.email || '',
                },
                theme: { color: '#10b981' },
                modal: { ondismiss: () => console.log('Payment closed') }
            };

            try {
                const rzp = new Razorpay(options);
                rzp.open();
            } catch (e) {
                console.error('Razorpay Error:', e);
                alert('Failed to open payment modal.');
            }
        });

        @this.on('paymentCompleted', () => {
            alert('Payment successful!');
            window.location.href = '{{ route("orders-index") }}';
        });

        @this.on('paymentFailed', () => {
            alert('Payment failed.');
        });
    });
    @this.on('paymentCompleted', () => {
    alert('Payment successful! Redirecting...');
    setTimeout(() => {
        window.location.href = '{{ route("orders-index") }}';
    }, 1000);
    });
</script>