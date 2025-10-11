<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUXORA by Ojas Jewel | Feel Luxury</title>
    <!-- Vite for Tailwind CSS and JavaScript -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="antialiased">
    <!-- Success Alert -->
    <div class="fixed top-4 right-4 w-full max-w-sm z-50 hidden" id="success-alert">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 flex justify-between items-center rounded-lg shadow-md">
            <span id="message"></span>
            <button type="button" class="text-green-700 hover:text-green-900" onclick="document.getElementById('success-alert').classList.add('hidden')" aria-label="Close alert">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Header -->
    <header>
        <!-- Jumbotron -->
        <div class="bg-white border-b border-gray-200 py-3 text-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <!-- Logo -->
                    <div class="flex justify-center md:justify-start w-full md:w-1/3 mb-3 md:mb-0">
                        <a href="/" class="ml-0 md:ml-2">
                            <img src="{{ asset('image/dark-logo.png') }}" alt="LUXORA by Ojas Jewel Logo" class="h-6">
                        </a>
                    </div>
                    <!-- Empty Middle Section -->
                    <div class="w-full md:w-1/3"></div>
                    <!-- User Actions -->
                    <div class="flex justify-center md:justify-end w-full md:w-1/3 items-center">
                        <div class="flex items-center space-x-4">
                            <a wire:navigate href="{{ url('/search') }}" class="text-gray-700 hover:text-gray-900" aria-label="Search products">
                                <i class="fas fa-search text-brand"></i>
                            </a>
                            @guest
                                @if (Route::has('login'))
                                    <a wire:navigate href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 font-medium">{{ __('Sign In') }}</a>
                                @endif
                                @if (Route::has('register'))
                                    <a wire:navigate href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900 font-medium">{{ __('Sign Up') }}</a>
                                @endif
                            @else
                                <div class="flex items-center space-x-4">
                                    <a href="#wishlistcanvas" class="text-red-500 hover:text-red-700" data-toggle="wishlistcanvas" aria-label="View wishlist">
                                        <i class="fas fa-heart"></i>
                                    </a>
                                    <a href="#cartcanvas" class="text-brand hover:text-gray-900" data-toggle="cartcanvas" aria-label="View cart">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                    <a href="#ordercanvas" class="text-brand hover:text-gray-900" data-toggle="ordercanvas" aria-label="View orders">
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </a>
                                    <div class="relative">
                                        <button class="text-gray-700 hover:text-gray-900 font-medium flex items-center" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                            {{ Auth::user()->name }}
                                            <i class="fas fa-chevron-down ml-1"></i>
                                        </button>
                                        <div class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-10" id="dropdown-menu">
                                            <a href="{{ url('/profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ __('Profile') }}</a>
                                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                               {{ __('Sign Out') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar -->
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-3">
                    <div class="flex items-center">
                        <button id="menu-toggle" class="md:hidden text-gray-700 hover:text-gray-900" aria-label="Toggle navigation">
                            <i class="fas fa-bars"></i>
                        </button>
                        <ul class="hidden md:flex space-x-4">
                            <li><a wire:navigate href="/all-products" class="text-gray-700 hover:text-gray-900 font-medium">All Products</a></li>
                            <li><a wire:navigate href="/categories" class="text-gray-700 hover:text-gray-900 font-medium">Categories</a></li>
                            <li><a wire:navigate href="/women" class="text-gray-700 hover:text-gray-900 font-medium">Women</a></li>
                            <li><a wire:navigate href="/men" class="text-gray-700 hover:text-gray-900 font-medium">Men</a></li>
                        </ul>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-phone text-gray-700"></i>
                        <span class="text-gray-700">{{ config('contact.phone', '+91-1234567890') }}</span>
                    </div>
                </div>
                <!-- Mobile Menu -->
                <div class="hidden md:hidden" id="mobile-menu">
                    <ul class="flex flex-col space-y-2 p-4 bg-gray-50">
                        <li><a wire:navigate href="/all-products" class="text-gray-700 hover:text-gray-900 font-medium">All Products</a></li>
                        <li><a wire:navigate href="/categories" class="text-gray-700 hover:text-gray-900 font-medium">Categories</a></li>
                        <li><a wire:navigate href="/women" class="text-gray-700 hover:text-gray-900 font-medium">Women</a></li>
                        <li><a wire:navigate href="/men" class="text-gray-700 hover:text-gray-900 font-medium">Men</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Orders Offcanvas -->
    <div class="fixed inset-y-0 right-0 w-full sm:w-96 bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-50" id="ordercanvas" aria-labelledby="ordercanvas-title">
        <div class="flex flex-col h-full">
            <div class="flex justify-between items-center p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold" id="ordercanvas-title">My Orders</h2>
                <button type="button" class="text-gray-700 hover:text-gray-900" onclick="document.getElementById('ordercanvas').classList.add('translate-x-full')" aria-label="Close orders">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto p-4">
                @if(Auth::user())
                    @forelse(Auth::user()->orders as $order)
                        <div class="border border-gray-200 rounded-lg p-3 mb-3">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium">Order ID: #ORD{{ $order->id }}</span>
                                @if($order->status == 'delivered')
                                    <a href="{{ url('/pdf/' . $order->id) }}" target="_blank" class="inline-flex items-center px-3 py-1 bg-brand text-white text-sm rounded hover:bg-brand-hover transition">
                                        <i class="fa-regular fa-circle-down mr-1"></i> Download Invoice
                                    </a>
                                @endif
                            </div>
                            @foreach($order->orderDetails as $ordItm)
                                <div class="bg-white shadow-md rounded-lg mb-2 p-3 relative">
                                    <a href="{{ url('product/' . $ordItm->product->id) }}" class="flex items-center text-gray-900 no-underline">
                                        <div class="w-1/3">
                                            <img src="{{ asset('storage/' . ($ordItm->product->images[0] ?? 'placeholder.png')) }}" alt="{{ $ordItm->product->name }}" class="w-full h-16 object-cover rounded">
                                        </div>
                                        <div class="w-2/3 pl-3">
                                            <p class="text-sm font-medium">{{ $ordItm->product->name }}</p>
                                            @php
                                                $price = isset($ordItm->product->productSizes[0])
                                                    ? $ordItm->product->productSizes[0]->metal_price + $ordItm->product->productSizes[0]->gemstone_price + $ordItm->product->productSizes[0]->making_charges + $ordItm->product->productSizes[0]->gst
                                                    : 0;
                                            @endphp
                                            <p class="text-sm">Rs. {{ $price }}</p>
                                        </div>
                                    </a>
                                    <div class="flex items-center space-x-2 absolute bottom-3 right-3">
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded
                                            {{ $order->status == 'pending' ? 'bg-gray-500' : '' }}
                                            {{ $order->status == 'delivered' ? 'bg-green-500' : '' }}
                                            {{ $order->status == 'cancelled' ? 'bg-red-500' : '' }}
                                            {{ $order->status == 'shipped' ? 'bg-yellow-500' : '' }} text-white">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                        <a href="{{ url('review/' . $ordItm->product_id) }}" class="inline-flex items-center px-2 py-1 bg-brand text-white text-xs rounded hover:bg-brand-hover transition">
                                            Rate Product
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="fas fa-bag-shopping text-4xl text-gray-400 mb-2"></i>
                            <h3 class="text-lg font-semibold">No Items Added!</h3>
                            <a href="/shop-all" class="mt-3 inline-flex items-center px-4 py-2 bg-brand text-white rounded hover:bg-brand-hover transition">Start Shopping</a>
                        </div>
                    @endforelse
                @endif
            </div>
        </div>
    </div>

    <!-- Register Livewire Component -->
    

    @livewireScripts
</body>
</html>