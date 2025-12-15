<header>
    <div class="bg-white py-3 text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex justify-center md:justify-start w-full md:w-1/3 mb-3 md:mb-0">
                    <a wire:navigate href="/" class="ml-0 md:ml-2">
                        <img src="{{ asset('image/dark-logo.png') }}" alt="PAGPRIYA by Ojas Jewel Logo" class="h-6">
                    </a>
                </div>

                <div class="flex justify-center md:justify-end w-full md:w-1/3 items-center">
                    <div class="flex items-center space-x-4">
                        <a wire:navigate href="{{ url('/search') }}" class="text-gray-700 hover:text-gray-900"
                            aria-label="Search products">
                            <i class="fas fa-search text-brand"></i>
                        </a>

                        @guest
                            @if (Route::has('login'))
                                <a wire:navigate href="{{ route('login') }}"
                                    class="text-gray-700 hover:text-gray-900 font-medium">{{ __('Sign In') }}</a>
                            @endif
                            @if (Route::has('register'))
                                <a wire:navigate href="{{ route('register') }}"
                                    class="text-gray-700 hover:text-gray-900 font-medium">{{ __('Sign Up') }}</a>
                            @endif
                        @else
                            <div class="flex items-center space-x-4">
                                <!-- Wishlist Icon -->
                                <button wire:click="openWishlist" class="text-red-500 hover:text-red-700"
                                    aria-label="View wishlist">
                                    <i class="fas fa-heart"></i>
                                </button>

                                <!-- Cart Icon -->
                                <button wire:click="openCart" class="text-brand hover:text-gray-900" aria-label="View cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>

                                <!-- Orders Icon -->
                                <button wire:click="openOrders" class="text-brand hover:text-gray-900"
                                    aria-label="View orders">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </button>

                                <!-- User Dropdown -->
                                <div class="relative">
                                    <button wire:click="toggleUserDropdown"
                                        class="text-gray-700 hover:text-gray-900 font-medium flex items-center"
                                        aria-expanded="{{ $userDropdownOpen ? 'true' : 'false' }}">
                                        {{ Auth::user()->name }}
                                        <i class="fas fa-chevron-down ml-1 transition-transform"
                                            :class="{ 'rotate-180': {{ $userDropdownOpen ? 'true' : 'false' }} }"></i>
                                    </button>

                                    <div wire:ignore x-data="{ open: @entangle('userDropdownOpen') }" x-show="open"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95" @click.outside="open = false"
                                        class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50">

                                        <a wire:navigate href="{{ url('/profile') }}"
                                            class="w-full text-center block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                            {{ __('Profile') }}
                                        </a>

                                        <button wire:click="logout"
                                            class="w-full text-center block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                            {{ __('Sign Out') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="bg-pink-200 shadow-sm sticky top-0 z-40 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-3">
                <div class="flex items-center">
                    <!-- Mobile Menu Toggle -->
                    <button wire:click="toggleMobileMenu" class="md:hidden text-gray-700 hover:text-gray-900"
                        aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Desktop Menu -->
                    <ul class="hidden md:flex space-x-6">
                        @auth
                            @if (Auth::user()->isVendor())
                                <li><a wire:navigate href="/vendorproducts"
                                        class="text-gray-700 hover:text-gray-900 font-medium">Products</a></li>
                                <li><a wire:navigate href="/vendorcart"
                                        class="text-gray-700 hover:text-gray-900 font-medium">Vendor Cart</a></li>
                            @else
                                <li><a wire:navigate href="/"
                                        class="text-gray-700 hover:text-gray-900 font-medium">Home</a></li>
                                <li><a wire:navigate href="/all-products"
                                        class="text-gray-700 hover:text-gray-900 font-medium">All Products</a></li>
                                <li><a wire:navigate href="/categories"
                                        class="text-gray-700 hover:text-gray-900 font-medium">Shop by Category</a></li>
                                <li><a wire:navigate href="/women"
                                        class="text-gray-700 hover:text-gray-900 font-medium">Women</a></li>
                                <li><a wire:navigate href="/men"
                                        class="text-gray-700 hover:text-gray-900 font-medium">Men</a></li>
                            @endif
                        @else
                            <li><a wire:navigate href="/"
                                    class="text-gray-700 hover:text-gray-900 font-medium">Home</a></li>
                            <li><a wire:navigate href="/all-products"
                                    class="text-gray-700 hover:text-gray-900 font-medium">All Products</a></li>
                            <li><a wire:navigate href="/categories"
                                    class="text-gray-700 hover:text-gray-900 font-medium">Shop by Category</a></li>
                            <li><a wire:navigate href="/women"
                                    class="text-gray-700 hover:text-gray-900 font-medium">Women</a></li>
                            <li><a wire:navigate href="/men"
                                    class="text-gray-700 hover:text-gray-900 font-medium">Men</a></li>
                        @endauth
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="flex items-center space-x-2 text-xs sm:text-sm">
                    <i class="fas fa-phone text-gray-700"></i>
                    <span class="text-gray-700">{{ config('contact.phone', '+91-8791242816') }}</span>
                    <i class="fas fa-envelope text-gray-700 ml-2"></i>
                    <span class="text-gray-700">{{ config('contact.email', 'help.pagpriya@gmail.com') }}</span>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div class="md:hidden" x-show="{{ $mobileMenuOpen }}" x-cloak>
                <ul class="flex flex-col space-y-3 p-4 bg-gray-50">
                    @auth
                        @if (Auth::user()->isVendor())
                            <li><a wire:navigate href="/vendorproducts"
                                    class="text-gray-700 hover:text-gray-900 font-medium">Products</a></li>
                            <li><a wire:navigate href="/vendorcart"
                                    class="text-gray-700 hover:text-gray-900 font-medium">Vendor Cart</a></li>
                        @else
                            <li><a wire:navigate href="/" class="text-gray-700 hover:text-gray-900">Home</a></li>
                            <li><a wire:navigate href="/all-products" class="text-gray-700 hover:text-gray-900">All
                                    Products</a></li>
                            <li><a wire:navigate href="/categories" class="text-gray-700 hover:text-gray-900">Shop by
                                    Category</a></li>
                            <li><a wire:navigate href="/women" class="text-gray-700 hover:text-gray-900">Women</a></li>
                            <li><a wire:navigate href="/men" class="text-gray-700 hover:text-gray-900">Men</a></li>
                        @endif
                    @else
                        <li><a wire:navigate href="/" class="text-gray-700 hover:text-gray-900">Home</a></li>
                        <li><a wire:navigate href="/all-products" class="text-gray-700 hover:text-gray-900">All
                                Products</a></li>
                        <li><a wire:navigate href="/categories" class="text-gray-700 hover:text-gray-900">Shop by
                                Category</a></li>
                        <li><a wire:navigate href="/women" class="text-gray-700 hover:text-gray-900">Women</a></li>
                        <li><a wire:navigate href="/men" class="text-gray-700 hover:text-gray-900">Men</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
