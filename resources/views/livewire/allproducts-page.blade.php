<div>
    <div class="container mx-auto px-0">
        <div class="flex flex-wrap -mx-2">
            <div class="w-full md:w-1/6 px-2">
                <div class="bg-white shadow-md rounded-lg mt-3">
                    <div class="bg-pink-600 bg-opacity-80 text-white px-4 py-2 rounded-t-lg">Category</div>
                    <div class="p-4">

                        @foreach ($categories as $category)
                            <label class="flex items-center">
                                <input type="checkbox" value="{{ $category->id }}" wire:model.live="category"
                                    class="mr-2 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                {{ $category->name }}
                            </label>
                            <br>
                        @endforeach
                    </div>
                </div>
                <div class="bg-white shadow-md rounded-lg mt-2">
                    <div class="bg-pink-600 bg-opacity-80 text-white px-4 py-2 rounded-t-lg">Occasion</div>
                    <div class="p-4">
                        @foreach ($occasions as $occasion)
                            <label class="flex items-center">
                                <input type="checkbox" value="{{ $occasion->id }}" wire:model.live="occasion"
                                    class="mr-2 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                {{ $occasion->name }}
                            </label>
                            <br>
                        @endforeach
                    </div>
                </div>
                {{-- <div class="bg-white shadow-md rounded-lg mt-2">
                    <div class="bg-pink-600 bg-opacity-80 text-white px-4 py-2 rounded-t-lg">Metal</div>
                    <div class="p-4">
                        @foreach ($metals as $metal)
                            <label class="flex items-center">
                                <input type="checkbox" value="{{ $metal->id }}" wire:model.live="metal"
                                    class="mr-2 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                {{ $metal->name }}
                            </label>
                            <br>
                        @endforeach
                    </div>
                </div> --}}
                <div class="bg-white shadow-md rounded-lg my-2">
                    <div class="bg-pink-600 bg-opacity-80 text-white px-4 py-2 rounded-t-lg">Offers</div>
                    <div class="p-4">

                        <label class="flex items-center">
                            <input type="checkbox" id="offer" value="true" wire:model.live="offer"
                                class="mr-2 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"><span>On
                                Sale</span>
                        </label>
                        <br>

                    </div>
                </div>
            </div>
            <div class="w-full md:w-5/6 px-2">
                {{-- <div class="px-2 mb-4 mt-2">
                    <div class="items-center justify-between hidden px-2 py-2  md:flex dark:bg-pink-900 ">
                        <div class="flex items-center justify-between gap-4">
                            <select name="sort" wire:model.live="sort"
                                class="block w-40 text-base  cursor-pointer dark:text-pink-400 dark:bg-pink-900">
                                <option value="latest">Sort by latest</option>
                                <option value="price">Sort by Price</option>
                            </select>
                            <select name="gender" wire:model.live="gender"
                                class="block w-42 text-base  cursor-pointer dark:text-pink-400 dark:bg-pink-900">
                                <option value="F">Sort by Women</option>
                                <option value="M">Sort by Men</option>
                            </select>
                        </div>
                    </div>
                </div> --}}
                <div class="flex flex-wrap items-center -mx-1">
                    @forelse($products as $product)
                        <div class="w-[18rem] p-0 bg-white shadow-md rounded-lg mt-3 mx-1"
                            wire:key="{{ $product->id }}">
                            <a wire:navigate href="{{ url('product/' . $product->id) }}"
                                class="no-underline text-gray-900 cursor-pointer">
                                <img src="{{ asset('storage/' . $product->images[0]) }}"
                                    class="w-full h-[220px] object-fit:cover rounded-t-lg" alt="Product image">
                            </a>
                            <div class="p-4">
                                <h5 class="text-lg font-semibold truncate w-64">{{ $product->name }}</h5>
                                <div class="flex justify-between items-center">
                                    <span class="text-base font-medium">
                                        <p>₹
                                            {{ $product->productSize[0]->metal_price + $product->productSize[0]->gemstone_price + $product->productSize[0]->making_charges + $product->productSize[0]->gst }}
                                        </p>
                                    </span>
                                    <span class="my-1 text-yellow-500">
                                        @php
                                            $rating = $product->review->first()->rating ?? 0;

                                        @endphp
                                        @for ($i = 0; $i < $rating; $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                    </span>
                                </div>
                                <div class="flex items-center justify-between mt-2">
                                    <a wire:navigate href="{{ url('product/' . $product->id) }}"
                                        class="bg-green-500 text-white text-sm px-3 py-1 rounded hover:bg-green-700">Shop
                                        Now</a>
                                    <div>
                                        <i x-data="{ isWishlisted: @js(in_array($product->id, $wishlist)) }"
                                            x-on:click="
                                    isWishlisted = !isWishlisted;
                                    @this.call('toggleWishlist', {{ $product->id }}, isWishlisted)
                                "
                                            :class="{
                                                'fa-solid fa-heart text-red-500': isWishlisted,
                                                'fa-regular fa-heart text-red-500': !isWishlisted
                                            }"
                                            class="text-2xl cursor-pointer transition-all hover:scale-110"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h3 class="text-center my-5 text-[#5C3422] text-2xl font-bold">No Products Available !!!
                        </h3>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

</div>
