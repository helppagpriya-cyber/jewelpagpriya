<div class="container mx-auto mb-4 mt-4">
    {{-- Success Message --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-transition
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button type="button" @click="show = false"
                class="absolute top-0 right-0 p-3 text-green-700 hover:text-green-900" aria-label="Close">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    @endif


    {{-- Warning Message --}}
    @if (session()->has('warning'))
        <div x-data="{ show: true }" x-show="show" x-transition
            class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4"
            role="alert">
            <span class="block sm:inline">{{ session('warning') }}</span>
            <button type="button" @click="show = false"
                class="absolute top-0 right-0 p-3 text-yellow-700 hover:text-yellow-900" aria-label="Close">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    @endif


    <div class="flex flex-wrap -mx-2 mt-4">
        <div class="w-full md:w-1/2 px-2">
            <div class="flex flex-wrap">
                <div id="carouselExample" class="relative w-full">
                    <div class="relative">
                        @foreach ($product->images as $key => $img)
                            <div class="relative {{ $key == 0 ? 'block' : 'hidden' }}">
                                <img src="{{ asset('storage/' . $img) }}"
                                    class="rounded-lg block w-full h-1/2 object-cover " alt="Product image">
                            </div>
                        @endforeach
                    </div>
                    <button class="absolute top-1/2 left-0 transform -translate-y-1/2 p-4" type="button"
                        data-bs-target="carouselExample" data-bs-slide="prev">
                        <span class="inline-block w-8 h-8 bg-black bg-opacity-50 rounded-full"
                            aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="absolute top-1/2 right-0 transform -translate-y-1/2 p-4" type="button"
                        data-bs-target="carouselExample" data-bs-slide="next">
                        <span class="inline-block w-8 h-8 bg-black bg-opacity-50 rounded-full"
                            aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 px-2">
            <h1 class="text-center text-4xl font-bold">{{ $product->name }}</h1>
            <p><b>About the Product :</b></p>
            {!! $product->description !!}

            <div>
                @if ($productSize)
                    <span>Select Product Size:</span>
                    @foreach ($productSize as $size)
                        <button type="button"
                            class="border {{ $productSize->id == $size->id ? 'border-red-900' : 'border-gray-300' }} px-3 py-1 rounded hover:bg-gray-100"
                            wire:click="setSize({{ $size->id }})">{{ $size->size }}</button>
                    @endforeach
                @endif
                @if ($product->productDiscounts->count() > 0)
                    @foreach ($product->productDiscounts as $discount)
                        @if ($discount->start_date <= \Carbon\Carbon::now() && $discount->end_date >= \Carbon\Carbon::now())
                            <div class="flex my-4">
                                <p class="text-3xl font-bold">₹
                                    {{ $productSize->metal_price + $productSize->gemstone_price + $productSize->making_charges + $productSize->gst - $discount->discount }}
                                </p>
                                <p class="line-through mx-3 text-gray-500">₹
                                    {{ $productSize->metal_price + $productSize->gemstone_price + $productSize->making_charges + $productSize->gst }}
                                </p>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="text-3xl font-bold mt-4">₹
                        {{ $productSize->metal_price + $productSize->gemstone_price + $productSize->making_charges + $productSize->gst }}
                    </p>
                @endif
                <p class="flex items-center">Quantity : &nbsp; <input type="number" wire:model.live="quantity"
                        value="1"
                        class="w-24 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </p>
                <div class="flex flex-wrap -mx-2 mt-4">
                    <div class="w-full md:w-1/2 px-2">
                        <button class="bg-yellow-500 text-white w-full py-2 rounded hover:bg-yellow-600"
                            wire:click="AddToCart()">Add To Cart</button>
                    </div>
                    <a wire:navigate href="{{ url('shop-now/' . $product->id) }}"
                        class="w-full md:w-5/12 mx-auto px-2 text-white bg-green-500 py-2 rounded text-center hover:bg-green-600">Shop
                        Now</a>
                </div>
                <h4 class="text-center text-xl font-semibold mt-5 mb-3">Other Details</h4>
                <table class="w-full border-collapse border border-gray-300 text-center">
                    @if ($product->occasion_id)
                        <tr>
                            <td class="font-bold border border-gray-300 p-2">Occasion</td>
                            <td class="border border-gray-300 p-2">{{ $product->occasion->name }}</td>
                        </tr>
                    @endif
                    @if ($product->metal_id)
                        <tr>
                            <td class="font-bold border border-gray-300 p-2">Metal</td>
                            <td class="border border-gray-300 p-2">{{ $product->metal->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold border border-gray-300 p-2">Metal Purity</td>
                            <td class="border border-gray-300 p-2">Pure Silver {{ $productSize->metal_purity }}</td>
                        </tr>
                        @if ($product->metal_id !== 1)
                            <tr>
                                <td class="font-bold border border-gray-300 p-2">Metal Price</td>
                                <td class="border border-gray-300 p-2">Rs. {{ $productSize->metal_price }}</td>
                            </tr>
                        @endif
                    @endif
                    @if ($product->gemstone_id)
                        <tr>
                            <td class="font-bold border border-gray-300 p-2">Gemstone</td>
                            <td class="border border-gray-300 p-2">{{ $product->gemstone->name }}</td>
                        </tr>
                        {{-- <tr>
                            <td class="font-bold border border-gray-300 p-2">Gemstone Purity</td>
                            <td class="border border-gray-300 p-2">{{ $productSize->gemstone_purity }}</td>
                        </tr> 
                        <tr>
                            <td class="font-bold border border-gray-300 p-2">Gemstone Price</td>
                            <td class="border border-gray-300 p-2">Rs. {{ $productSize->gemstone_price }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold border border-gray-300 p-2">No. of Gemstone</td>
                            <td class="border border-gray-300 p-2">{{ $productSize->num_of_gemstone }}</td>
                        </tr> --}}
                    @endif
                    <tr>
                        <td class="font-bold border border-gray-300 p-2">MRP</td>
                        <td class="border border-gray-300 p-2">
                            ₹{{ $productSize->gemstone_price + $productSize->metal_price + $productSize->gst + $productSize->making_charges }}/-
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    {{-- section 1 --}}

    @if ($product->review->count() > 0)
        <hr class="my-4">
        <h5 class="text-lg font-semibold">Top Reviews :</h5>
    @endif
    {{-- reviews --}}
    @forelse($product->review as $review)
        <div class="flex flex-wrap my-2">
            <div class="flex items-center">
                <img src="{{ asset('storage/' . ($review->user->avatar ?? 'img.png')) }}"
                    class="rounded-full w-[50px] h-[50px] object-cover" alt="User Image">
                <span class="ml-1">{{ $review->user->name }}</span>
            </div>
            <div class="flex mx-2">
                @for ($i = 0; $i < $review->rating; $i++)
                    <i class="fa-solid fa-star text-yellow-500 inline"></i>
                @endfor
            </div>
            <span class="ml-2">{{ $review->comment ?? '' }}</span>
            <div class="flex ml-1">
                @if ($review->image)
                    @foreach ($review->image as $img)
                        <img src="{{ asset('storage/' . $img) }}"
                            class="rounded mx-1 my-0 p-0 w-[80px] h-[80px] object-cover" alt="User Image">
                    @endforeach
                @endif
            </div>
        </div>
    @empty
    @endforelse
    {{-- reviews --}}
    <div>
    </div>
</div>
