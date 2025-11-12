<div class="fixed inset-y-0 right-0 w-full sm:w-96 bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-50"
     id="ordercanvas" aria-labelledby="ordercanvas-title">
    <div class="flex flex-col h-full">
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold" id="ordercanvas-title">My Orders</h2>
            <button type="button" class="text-gray-700 hover:text-gray-900"
                    onclick="document.getElementById('ordercanvas').classList.add('translate-x-full')"
                    aria-label="Close orders">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto p-4">
            @if($orders->count())
                @foreach($orders as $order)
                    <div class="border border-gray-200 rounded-lg p-2 mb-2">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium">Order ID: #ORD{{ $order->id }}</span>
                            @if($order->status == 'delivered')
                                <a href="{{ url('/pdf/' . $order->id) }}" target="_blank"
                                   class="inline-flex items-center px-3 py-1 bg-brand text-white text-sm rounded hover:bg-brand-hover transition">
                                    <i class="fa-regular fa-circle-down mr-1"></i> Download Invoice
                                </a>
                            @endif
                        </div>

           @foreach($order->orderDetails as $item)
    @php
        $price = $item->product->productSizes[0] ?? null
               ? $item->product->productSizes[0]->metal_price
               + $item->product->productSizes[0]->gemstone_price
               + $item->product->productSizes[0]->making_charges
               + $item->product->productSizes[0]->gst
               : 0;
    @endphp

    <div class="bg-white shadow-md rounded-lg mb-2 p-3">
        <a href="{{ url('product/' . $item->product_id) }}"
           class="flex items-start text-gray-900 no-underline">

            {{-- Product image --}}
            <div class="w-1/3">
                <img src="{{ asset('storage/' . ($item->product->images[0] ?? 'placeholder.png')) }}"
                     alt="{{ $item->product->name }}"
                     class="w-full h-16 object-cover rounded">
            </div>

            {{-- Product info + actions --}}
            <div class="w-2/3 pl-3 flex flex-col justify-between h-full">
                <div>
                    <p class="text-sm font-medium">{{ $item->product->name }}</p>
                    <p class="text-sm text-gray-700">Rs. {{ $price }}</p>
                </div>

                {{-- Bottom row: Status | Invoice (if delivered) | Rate --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-3 gap-2">
                    {{-- Status badge --}}
                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded text-white
                        {{ $order->status == 'pending'   ? 'bg-gray-500' :
                           ($order->status == 'delivered' ? 'bg-green-500' :
                           ($order->status == 'cancelled' ? 'bg-red-500' :
                           ($order->status == 'shipped'   ? 'bg-yellow-500' : 'bg-gray-500'))) }}">
                        {{ ucfirst($order->status) }}
                    </span>

                    {{-- Download Invoice – only when order is delivered --}}
                    @if($order->status === 'delivered')
                        <a href="{{ url('/pdf/' . $order->id) }}" target="_blank"
                           class="inline-flex items-center px-2 py-1 bg-brand text-white text-xs rounded hover:bg-brand-hover transition">
                            <i class="fa-regular fa-circle-down mr-1"></i> Invoice
                        </a>
                    @endif

                    {{-- Rate Product --}}
                    <a href="{{ url('review/' . $item->product_id) }}"
                       class="inline-flex items-center px-2 py-1 bg-brand text-white text-xs rounded hover:bg-brand-hover transition">
                        Rate Product
                    </a>
                </div>
            </div>
        </a>
    </div>
@endforeach
                    </div>
                @endforeach
            @else
                <div class="text-center py-8">
                    <i class="fas fa-bag-shopping text-4xl text-gray-400 mb-2"></i>
                    <h3 class="text-lg font-semibold">No Items Added!</h3>
                    <a href="/all-product"
                       class="mt-3 inline-flex items-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-800 transition">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>