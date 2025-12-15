@extends('layout.app')
@section('content')
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('success') }}
            <button type="button" class="absolute top-0 right-0 p-3" data-bs-dismiss="alert" aria-label="Close">
                <span class="text-green-700">&times;</span>
            </button>
        </div>
    @endif
    <livewire:heroslider />



    {{-- static data --}}
    <div class="container mx-auto">
        <div class="flex flex-wrap mt-3 -mx-2">
            <div class="w-full md:w-1/3 px-2">
                <div class="bg-white shadow-md rounded-lg p-2">
                    <div class="flex items-center justify-center text-blue-900">
                        <div class="mx-3 p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                                class="bi bi-file-earmark-lock" viewBox="0 0 16 16">
                                <path
                                    d="M10 7v1.076c.54.166 1 .597 1 1.224v2.4c0 .816-.781 1.3-1.5 1.3h-3c-.719 0-1.5-.484-1.5-1.3V9.3c0-.627.46-1.058 1-1.224V7a2 2 0 1 1 4 0M7 7v1h2V7a1 1 0 0 0-2 0M6 9.3v2.4c0 .042.02.107.105.175A.64.64 0 0 0 6.5 12h3a.64.64 0 0 0 .395-.125c.085-.068.105-.133.105-.175V9.3c0-.042-.02-.107-.105-.175A.64.64 0 0 0 9.5 9h-3a.64.64 0 0 0-.395.125C6.02 9.193 6 9.258 6 9.3" />
                                <path
                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                            </svg>
                        </div>
                        <div class="p-3">
                            <h5 class="text-xl font-semibold">Secure Payment</h5>
                            <p>We offer secure shopping facilities.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/3 px-2">
                <div class="bg-white shadow-md rounded-lg p-2">
                    <div class="flex items-center justify-center text-blue-900">
                        <div class="mx-3 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                                class="bi bi-wallet2" viewBox="0 0 16 16">
                                <path
                                    d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                            </svg>
                        </div>
                        <div class="p-3">
                            <h5 class="text-xl font-semibold">100% Satisfaction</h5>
                            <p>We provide 100% satisfaction on every shopping.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/3 px-2">
                <div class="bg-white shadow-md rounded-lg p-2">
                    <div class="flex items-center justify-center text-blue-900">
                        <div class="mx-3 p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                                class="bi bi-truck" viewBox="0 0 16 16">
                                <path
                                    d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                            </svg>
                        </div>
                        <div class="p-3">
                            <h5 class="text-xl font-semibold">Easy Return</h5>
                            <p>We offer the easiest return to all users.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- static data --}}

    {{-- cards --}}
    <div class="container mx-auto py-5">
        <h2 class="text-center text-3xl font-bold">Latest Products</h2>
        <div class="flex flex-wrap items-center justify-center gap-4 my-4">
            @foreach ($latestProduct as $latest)
                <div class="w-[18rem] p-0 bg-white rounded-lg shadow-md">
                    <a wire:navigate href="{{ url('product/' . $latest->id) }}"
                        class="no-underline text-gray-900 cursor-pointer">
                        <img src="{{ asset('storage/' . $latest->images[0]) }}"
                            class="w-full h-[220px] object-cover rounded-t-lg" alt="Product image">
                    </a>
                    <div class="p-4">
                        <h5 class="text-xl font-semibold">{{ $latest->name }}</h5>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-medium">Rs.
                                {{ $latest->productSize[0]->metal_price + $latest->productSize[0]->gemstone_price + $latest->productSize[0]->making_charges + $latest->productSize[0]->gst }}</span>
                            <span class="my-1 text-yellow-500">
                                @php
                                    $rating = $latest->review->first()->rating ?? 0;
                                @endphp
                                @for ($i = 0; $i < $rating; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                            </span>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <a wire:navigate href="{{ url('shop-now/' . $latest->id) }}"
                                class="bg-green-600 text-white text-sm px-4 py-2 rounded hover:bg-green-700">Shop Now</a>
                            <div>
                                <div class="mt-3">
                                    @livewire('product-wishlist', ['product' => $latest], key($latest->id))
                                </div>
                                {{-- @if (in_array($latest->id, $wishlist))
                                <i class="fa-solid fa-heart text-2xl text-red-500 heart cursor-pointer" data-product-id="{{ $latest->id }}"></i>
                            @else
                                <i class="fa-regular fa-heart text-2xl text-red-500 heart cursor-pointer" data-product-id="{{ $latest->id }}"></i>
                            @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h2 class="text-center text-3xl font-bold mt-5">Customer's First Choice</h2>
        <p class="text-center text-gray-600">Our highly rated & Most loved products</p>
        <div class="flex flex-wrap items-center justify-center gap-4 my-4">
            @foreach ($highlyRated as $rated)
                <div class="w-[18rem] p-0 bg-white rounded-lg shadow-md">
                    <a wire:navigate href="{{ url('product/' . $rated->product->id) }}"
                        class="no-underline text-gray-900 cursor-pointer">
                        <img src="{{ asset('storage/' . $rated->product->images[0]) }}"
                            class="w-full h-[220px] object-cover rounded-t-lg" alt="Product image">
                    </a>
                    <div class="p-4">
                        <h5 class="text-xl font-semibold">{{ $rated->product->name }}</h5>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-medium">Rs.
                                {{ $rated->product->productSize[0]->metal_price + $rated->product->productSize[0]->gemstone_price + $rated->product->productSize[0]->making_charges + $rated->product->productSize[0]->gst }}</span>
                            <span class="my-1 text-yellow-500">
                                @php
                                    $rating = $rated->product->review->first()->rating ?? 0;
                                @endphp
                                @for ($i = 0; $i < $rating; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                            </span>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <a wire:navigate href="{{ url('shop-now/' . $rated->product->id) }}"
                                class="bg-green-600 text-white text-sm px-4 py-2 rounded hover:bg-green-700">Shop Now</a>
                            <div class="mt-3">
                                @livewire('product-wishlist', ['product' => $rated->product], key($rated->product->id))
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @livewire('cart-component')
    </div>
@endsection
