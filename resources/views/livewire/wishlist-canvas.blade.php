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
                <h2 class="text-lg font-semibold" id="wishlistcanvas-title">My Wishlist</h2>
                <button wire:click="close" type="button" class="text-gray-700 hover:text-gray-900"
                    aria-label="Close wishlist">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Content -->
            <div class="flex-1 overflow-y-auto p-4">
                @if ($wishlists->count())
                    @foreach ($wishlists as $w)
                        @php
                            $price = 0;
                            if ($w->product->productSize->first()) {
                                $size = $w->product->productSize->first();
                                $price =
                                    $size->metal_price + $size->gemstone_price + $size->making_charges + $size->gst;
                            }
                        @endphp
                        <div class="bg-white shadow-md rounded-lg mb-3 p-3 relative">
                            <a wire:navigate href="{{ url('product/' . $w->product_id) }}"
                                class="flex items-center text-gray-900 no-underline">
                                <div class="w-1/3">
                                    <img src="{{ asset('storage/' . ($w->product->images[0] ?? 'placeholder.png')) }}"
                                        alt="{{ $w->product->name }}" class="w-full h-16 object-cover rounded">
                                </div>
                                <div class="w-2/3 pl-3">
                                    <p class="text-sm font-medium">{{ $w->product->name }}</p>
                                    <p class="text-sm">Rs. {{ number_format($price, 2) }}</p>
                                </div>
                            </a>
                            <button wire:click="removeFromWishlist({{ $w->product_id }})"
                                class="absolute top-3 right-3 text-red-500 hover:text-red-700"
                                aria-label="Remove from wishlist">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-heart text-4xl text-gray-400 mb-2"></i>
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
