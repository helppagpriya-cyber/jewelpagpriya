<div class="container mx-auto min-h-[500px] px-2 sm:px-4 py-4">
    {{-- Search Bar --}}
    <form class="flex items-center w-full my-2 sm:my-auto mb-3 sm:mb-0">
        <input autocomplete="off" type="search"
            class="block w-full border-gray-300 rounded-l-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base sm:text-sm py-2 sm:py-1.5"
            placeholder="Search Products" wire:model.live="search" />
        <span class="bg-green-600 text-white border-none px-3 py-2 rounded-r-md flex items-center">
            <i class="fas fa-search"></i>
        </span>
    </form>

    <livewire:filter :products="$products" :gender="$gender" />
    <div class="flex flex-wrap items-center -mx-1">
        @forelse($products as $product)
            <div class="w-full sm:w-[18rem] p-0 bg-white shadow-md rounded-lg mt-3 mx-1">
                <a wire:navigate href="{{ url('product/' . $product->id) }}"
                    class="no-underline text-gray-900 cursor-pointer">
                    <img src="{{ asset('storage/' . $product->images[0]) }}"
                        class="w-full h-[180px] sm:h-[220px] object-cover rounded-t-lg" alt="Product image">
                </a>
                <div class="p-3 sm:p-4">
                    <h5 class="text-base sm:text-lg font-semibold">{{ $product->name }}</h5>
                    <p class="text-sm sm:text-base font-medium">
                        <strong>Rs.
                        </strong>{{ $product->productSize[0]->metal_price + $product->productSize[0]->gemstone_price + $product->productSize[0]->making_charges + $product->productSize[0]->gst }}
                    </p>
                    <div class="flex items-center justify-between mt-2">
                        <a wire:navigate href="{{ url('shop-now/' . $product->id) }}"
                            class="bg-green-600 text-white text-sm px-3 py-1.5 rounded hover:bg-green-700 touch-manipulation">Shop
                            Now</a>
                        <div>
                            @if (in_array($product->id, $wishlist))
                                <i class="fa-solid fa-heart text-lg sm:text-xl text-red-500 heart cursor-pointer touch-manipulation"
                                    data-product-id="{{ $product->id }}"></i>
                            @else
                                <i class="fa-regular fa-heart text-lg sm:text-xl text-red-500 heart cursor-pointer touch-manipulation"
                                    data-product-id="{{ $product->id }}"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <h3 class="text-center my-5 text-xl sm:text-2xl font-bold">No Products Available !!!</h3>
        @endforelse
    </div>
</div>
