<header>
    <!-- Header / Jumbotron -->
    <div class="bg-white py-3 text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <!-- Logo -->
                <div class="flex justify-center md:justify-start w-full md:w-1/3 mb-3 md:mb-0">
                    <a href="/" class="ml-0 md:ml-2">
                        <img src="{{ asset('image/dark-logo.png') }}" alt="PAGPRIYA by Ojas Jewel Logo" class="h-6">
                    </a>
                </div>

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
                                <a href="" class="text-red-500 hover:text-red-700" data-toggle="wishlistcanvas" aria-label="View wishlist">
                                    <i class="fas fa-heart"></i>
                                </a>

                                <a href="" class="text-brand hover:text-gray-900" data-toggle="cartcanvas" aria-label="View cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>

                                <a href="" class="text-brand hover:text-gray-900" data-toggle="ordercanvas" aria-label="View orders">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </a>

                                <div class="relative">
                                    <button class="text-gray-700 hover:text-gray-900 font-medium flex items-center"
                                            id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                        <i class="fas fa-chevron-down ml-1"></i>
                                    </button>

                                    <div class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50"
                                         id="dropdown-menu">
                                        <a wire:navigate href="{{ url('/profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ __('Profile') }}</a>
                                        <a wire:navigate href="{{ route('logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
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
    <nav class="bg-pink-200 shadow-sm sticky top-0 z-40 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-3">
                <div class="flex items-center">
                    <button id="menu-toggle" class="md:hidden text-gray-700 hover:text-gray-900" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>

                    <ul class="hidden md:flex space-x-4">
                        <li><a wire:navigate href="/all-products" class="text-gray-700 hover:text-gray-900 font-medium">All Products</a></li>
                        <li><a wire:navigate href="/categories" class="text-gray-700 hover:text-gray-900 font-medium">Shop by Category</a></li>
                        <li><a wire:navigate href="/women" class="text-gray-700 hover:text-gray-900 font-medium">Women</a></li>
                        <li><a wire:navigate href="/men" class="text-gray-700 hover:text-gray-900 font-medium">Men</a></li>
                    </ul>
                </div>

                <div class="flex items-center space-x-2">
                    <i class="fas fa-phone text-gray-700"></i>
                    <span class="text-gray-700">{{ config('contact.phone', '+91-8791242816') }}</span>
                    <i class="fas fa-envelope text-gray-700"></i>
                    <span class="text-gray-700">{{ config('contact.email', 'help.pagpriya@gmail.com') }}</span>
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