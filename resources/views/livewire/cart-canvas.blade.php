<div>
    <!-- Backdrop -->
    <div x-data x-show="$wire.open" class="fixed inset-0 bg-black bg-opacity-50 z-40" @click="$wire.close()" wire:ignore>
    </div>

    <!-- Canvas Panel -->
    <div x-data x-show="$wire.open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="transform translate-x-0"
        x-transition:leave-end="transform translate-x-full"
        class="fixed inset-y-0 right-0 w-full sm:w-96 bg-white shadow-xl z-50" wire:ignore>

        <div class="flex flex-col h-full">
            <!-- Header -->
            <div class="flex justify-between items-center p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold" id="cartcanvas-title">My Cart</h2>
                <button wire:click="close" type="button" class="text-gray-700 hover:text-gray-900"
                    aria-label="Close cart">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Content -->
            <div class="flex-1 overflow-y-auto p-4">
                @if ($carts->count())
                    @foreach ($carts as $cart)
                        @php
                            $price = 0;
                            if ($cart->productSize) {
                                $price =
                                    $cart->productSize->metal_price +
                                    $cart->productSize->gemstone_price +
                                    $cart->productSize->making_charges +
                                    $cart->productSize->gst;
                            }
                        @endphp
                        <div class="bg-white shadow-md rounded-lg mb-3 p-3 relative">
                            <a wire:navigate href="{{ url('product/' . $cart->product_id) }}"
                                class="flex items-center text-gray-900 no-underline">
                                <div class="w-1/3">
                                    <img src="{{ asset('storage/' . ($cart->product->images[0] ?? 'placeholder.png')) }}"
                                        alt="{{ $cart->product->name }}" class="w-full h-16 object-cover rounded">
                                </div>
                                <div class="w-2/3 pl-3">
                                    <p class="text-sm font-medium">{{ $cart->product->name }}</p>
                                    <div class="flex items-center mt-1">
                                        <span class="text-sm">Rs.
                                            {{ number_format($cart->quantity * $price, 2) }}</span>
                                        <input type="number"
                                            wire:model.live.debounce.500ms="quantities.{{ $cart->product_id }}"
                                            wire:change="updateQuantity({{ $cart->product_id }}, $event.target.value)"
                                            value="{{ $cart->quantity }}" min="1"
                                            class="ml-4 w-20 p-1 border border-gray-300 rounded text-sm focus:ring focus:ring-brand focus:border-brand">
                                    </div>
                                </div>
                            </a>
                            <button wire:click="removeFromCart({{ $cart->product_id }})"
                                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
                                aria-label="Remove from cart">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endforeach

                    <div class="bg-white shadow-md rounded-lg p-4 mt-4">
                        <h3 class="text-lg font-semibold text-center">Summary</h3>
                        <hr class="my-2 border-gray-200">
                        <p class="text-sm"><span class="font-medium">Price:</span> Rs. {{ number_format($tprice, 2) }}
                        </p>
                        <p class="text-sm"><span class="font-medium">Delivery Charge:</span> Rs.
                            {{ number_format($tdelivery, 2) }}</p>
                        <hr class="my-2 border-gray-200">
                        <p class="text-sm"><span class="font-medium">Total:</span> Rs.
                            {{ number_format($tprice + $tdelivery, 2) }}</p>
                        <a wire:navigate href="/checkout" {{-- Change to your checkout route --}}
                            class="mt-3 w-full inline-flex justify-center items-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-800 transition">
                            Proceed to Checkout {{-- Updated from "Shop Now" for better UX --}}
                        </a>
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-shopping-cart text-4xl text-gray-400 mb-2"></i>
                        <h3 class="text-lg font-semibold">No Items Added!</h3>
                        <a wire:navigate href="/shop-all"
                            class="mt-3 inline-flex items-center px-4 py-2 bg-brand text-white rounded hover:bg-brand-hover transition">
                            Start Shopping
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
