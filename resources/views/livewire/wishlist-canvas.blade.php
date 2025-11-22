<div class="fixed inset-y-0 right-0 w-full sm:w-96 bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-50"
     id="wishlistcanvas" aria-labelledby="wishlistcanvas-title">
    <div class="flex flex-col h-full">
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold" id="wishlistcanvas-title">My Wishlist</h2>
            <button type="button" class="text-gray-700 hover:text-gray-900"
                    onclick="document.getElementById('wishlistcanvas').classList.add('translate-x-full')"
                    aria-label="Close wishlist">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto p-4">
            @if($wishlists->count())
                @foreach($wishlists as $w)
                    @php
                        $price = $w->product->productSizes[0] ?? null
                               ? $w->product->productSizes[0]->metal_price
                               + $w->product->productSizes[0]->gemstone_price
                               + $w->product->productSizes[0]->making_charges
                               + $w->product->productSizes[0]->gst
                               : 0;
                    @endphp
                    <div class="bg-white shadow-md rounded-lg mb-3 p-3 relative">
                        <a href="{{ url('product/' . $w->product_id) }}" class="flex items-center text-gray-900 no-underline">
                            <div class="w-1/3">
                                <img src="{{ asset('storage/' . ($w->product->images[0] ?? 'placeholder.png')) }}"
                                     alt="{{ $w->product->name }}" class="w-full h-16 object-cover rounded">
                            </div>
                            <div class="w-2/3 pl-3">
                                <p class="text-sm font-medium">{{ $w->product->name }}</p>
                                <p class="text-sm">Rs. {{ $price }}</p>
                            </div>
                        </a>
                        <button wire:click="removeFromWishlist({{ $w->product_id }})"
                                class="absolute top-3 right-3 text-red-500 hover:text-red-700" aria-label="Remove from wishlist">
                            <i class="fa-solid fa-heart"></i>
                        </button>
                    </div>
                @endforeach
            @else
                <div class="text-center py-8">
                    <i class="fas fa-heart text-4xl text-gray-400 mb-2"></i>
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