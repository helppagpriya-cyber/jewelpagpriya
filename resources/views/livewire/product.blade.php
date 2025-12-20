<div class="container mx-auto my-8">
    <!-- Success / Warning Messages -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition
            class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button @click="show = false" class="absolute top-2 right-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @endif

    @if (session('warning'))
        <div x-data="{ show: true }" x-show="show" x-transition
            class="mb-6 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative"
            role="alert">
            <span class="block sm:inline">{{ session('warning') }}</span>
            <button @click="show = false" class="absolute top-2 right-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @endif

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Product Images -->
        <div class="md:w-1/2">
            <div id="productCarousel" class="relative">
                <div class="overflow-hidden rounded-lg">
                    @foreach ($product->images as $index => $image)
                        <div class="{{ $index === 0 ? 'block' : 'hidden' }} w-full">
                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}"
                                class="w-full h-auto object-cover rounded-lg">
                        </div>
                    @endforeach
                </div>

                <!-- Carousel Controls (you can enhance with real carousel JS if needed) -->
                <button class="absolute top-1/2 left-4 -translate-y-1/2 bg-black/50 text-white p-2 rounded-full"
                    type="button" onclick="prevSlide()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button class="absolute top-1/2 right-4 -translate-y-1/2 bg-black/50 text-white p-2 rounded-full"
                    type="button" onclick="nextSlide()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Product Details -->
        <div class="md:w-1/2">
            <h1 class="text-4xl font-bold text-center mb-6">{{ $product->name }}</h1>

            <div class="mb-6">
                <p class="font-semibold mb-2">About the Product:</p>
                {!! $product->description !!}
            </div>

            <!-- Size Selection -->


            <!-- Price -->
            <div class="mb-6">
                @php
                    $basePrice =
                        $selectedSize->metal_price +
                        $selectedSize->gemstone_price +
                        $selectedSize->making_charges +
                        $selectedSize->gst;
                    $activeDiscount = $product->productDiscounts->first(
                        fn($d) => $d->start_date <= now() && $d->end_date >= now(),
                    );
                    $finalPrice = $activeDiscount ? $basePrice - $activeDiscount->discount : $basePrice;
                @endphp

                <div class="flex items-baseline gap-4">
                    <p class="text-3xl font-bold text-red-600">₹{{ number_format($finalPrice) }}</p>
                    @if ($activeDiscount)
                        <p class="text-xl text-gray-500 line-through">₹{{ number_format($basePrice) }}</p>
                        <span class="text-green-600 font-medium">({{ $activeDiscount->discount }} off)</span>
                    @endif
                </div>
            </div>

            <!-- Quantity & Actions -->
            <div class="mb-8">
                <label class="block mb-2">Quantity:
                    <input type="number" wire:model.live="quantity" min="1" value="1"
                        class="ml-2 w-20 border rounded px-2 py-1">
                </label>
            </div>

            <div class="flex flex-col sm:flex-row gap-4">
                <button wire:click="addToCart"
                    class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-3 rounded transition">
                    Add to Cart
                </button>
                <a wire:navigate href="{{ url('shop-now/' . $product->id) }}"
                    class="flex-1 text-center bg-green-500 hover:bg-green-600 text-white font-medium py-3 rounded transition">
                    Buy Now
                </a>
            </div>

            <!-- Product Details Table -->
            <h4 class="text-xl font-semibold my-6 text-center">Product Details</h4>
            <table class="w-full border border-gray-300 text-center">
                <tbody>
                    @if ($product->occasion)
                        <tr>
                            <td class="font-bold border border-gray-300 p-3">Occasion</td>
                            <td class="border border-gray-300 p-3">{{ $product->occasion->name }}</td>
                        </tr>
                    @endif

                    @if ($product->metal)
                        <tr>
                            <td class="font-bold border border-gray-300 p-3">Metal</td>
                            <td class="border border-gray-300 p-3">{{ $product->metal->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold border border-gray-300 p-3">Metal Purity</td>
                            <td class="border border-gray-300 p-3">Pure Silver {{ $selectedSize->metal_purity }}</td>
                        </tr>
                        @if ($product->metal_id !== 1)
                            <tr>
                                <td class="font-bold border border-gray-300 p-3">Metal Price</td>
                                <td class="border border-gray-300 p-3">₹{{ $selectedSize->metal_price }}</td>
                            </tr>
                        @endif
                    @endif

                    @if ($product->gemstone)
                        <tr>
                            <td class="font-bold border border-gray-300 p-3">Gemstone</td>
                            <td class="border border-gray-300 p-3">{{ $product->gemstone->name }}</td>
                        </tr>
                    @endif

                    <tr>
                        <td class="font-bold border border-gray-300 p-3">MRP (incl. GST)</td>
                        <td class="border border-gray-300 p-3">₹{{ number_format($basePrice) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Reviews Section -->
    @if ($product->review->count() > 0)
        <hr class="my-10">
        <h5 class="text-2xl font-semibold mb-6">Customer Reviews</h5>

        @foreach ($product->review as $review)
            <div class="flex flex-col sm:flex-row gap-4 my-6 border-b pb-6">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('storage/' . ($review->user->avatar ?? 'img.png')) }}"
                        alt="{{ $review->user->name }}" class="w-12 h-12 rounded-full object-cover">
                    <div>
                        <p class="font-medium">{{ $review->user->name }}</p>
                        <div class="flex text-yellow-500">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa{{ $i <= $review->rating ? '-solid' : '-regular' }} fa-star"></i>
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="flex-1">
                    <p>{{ $review->comment ?? 'No comment.' }}</p>
                    @if ($review->image)
                        <div class="flex gap-2 mt-3">
                            @foreach ($review->image as $img)
                                <img src="{{ asset('storage/' . $img) }}" class="w-20 h-20 object-cover rounded"
                                    alt="Review image">
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
