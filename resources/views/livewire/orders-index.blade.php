<div class="p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Your Orders</h2>

    @if ($orders->count())
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Order ID</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Total</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Payment</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Tracking No</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($orders as $order)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->id }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ ucfirst($order->status) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">₹{{ number_format($order->total_amount, 2) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">
                                {{ ucfirst($order->payment_status) }} <br>
                                <span class="text-xs text-gray-500">{{ $order->payment_mode }}</span>
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->tracking_no ?? '—' }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    @else
        <p class="text-gray-600">You have no orders yet.</p>
    @endif
</div>
