<div class="fixed inset-y-0 right-0 w-full sm:w-96 bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-50"
     id="cartcanvas" aria-labelledby="cartcanvas-title">
    <div class="flex flex-col h-full">
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold" id="cartcanvas-title">My Cart</h2>
            <button type="button" class="text-gray-700 hover:text-gray-900"
                    onclick="document.getElementById('cartcanvas').classList.add('translate-x-full')"
                    aria-label="Close cart">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto p-4">
            @if($carts->count())
                @foreach($carts as $cart)
                    @php
                        $price = $cart->productSize?->metal_price
                               + $cart->productSize?->gemstone_price
                               + $cart->productSize?->making_charges
                               + $cart->productSize?->gst ?? 0;
                    @endphp
                    <div class="bg-white shadow-md rounded-lg mb-3 p-3 relative"
                         id="cart-item-{{ $cart->product_id }}">
                        <a href="{{ url('product/' . $cart->product_id) }}" class="flex items-center text-gray-900 no-underline">
                            <div class="w-1/3">
                                <img src="{{ asset('storage/' . ($cart->product->images[0] ?? 'placeholder.png')) }}"
                                     alt="{{ $cart->product->name }}" class="w-full h-16 object-cover rounded">
                            </div>
                            <div class="w-2/3 pl-3">
                                <p class="text-sm font-medium">{{ $cart->product->name }}</p>
                                <div class="flex items-center mt-1">
                                    <span class="text-sm">Rs. {{ $cart->quantity * $price }}</span>
                                    <input type="number"
                                           wire:model.live.debounce.500ms="quantities.{{ $cart->product_id }}"
                                           wire:change="updateQuantity({{ $cart->product_id }}, $event.target.value)"
                                           value="{{ $cart->quantity }}" min="1"
                                           class="ml-4 w-20 p-1 border border-gray-300 rounded text-sm focus:ring focus:ring-brand focus:border-brand">
                                </div>
                            </div>
                        </a>
                        <button wire:click="removeFromCart({{ $cart->product_id }})"
                                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700" aria-label="Remove from cart">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endforeach

                <div class="bg-white shadow-md rounded-lg p-4 mt-4">
                    <h3 class="text-lg font-semibold text-center">Summary</h3>
                    <hr class="my-2 border-gray-200">
                    <p class="text-sm"><span class="font-medium">Price:</span> Rs. {{ $tprice }}</p>
                    <p class="text-sm"><span class="font-medium">Delivery Charge:</span> Rs. {{ $tdelivery }}</p>
                    <hr class="my-2 border-gray-200">
                    <p class="text-sm"><span class="font-medium">Total:</span> Rs. {{ $tprice + $tdelivery }}</p>
                    <a href="/shop-all"
                       class="mt-3 w-full inline-flex justify-center items-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-800 transition">
                        Shop Now
                    </a>
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-shopping-cart text-4xl text-gray-400 mb-2"></i>
                    <h3 class="text-lg font-semibold">No Items Added!</h3>
                    <a href="/shop-all"
                       class="mt-3 inline-flex items-center px-4 py-2 bg-brand text-white rounded hover:bg-brand-hover transition">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>