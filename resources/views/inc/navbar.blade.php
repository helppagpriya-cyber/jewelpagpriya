<!-- Header -->
<!-- Jumbotron -->
<div class="bg-white py-3 text-center">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <!-- Logo -->
            <div class="flex justify-center md:justify-start w-full md:w-1/3 mb-3 md:mb-0">
                <a href="/" class="ml-0 md:ml-2">
                    <img src="{{ asset('image/dark-logo.png') }}" alt="PAGPRIYA by Ojas Jewel Logo" class="h-6">
                </a>
            </div>
            <!-- Empty Middle Section -->


            <!-- User Actions -->
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
                            <div class="flex items-center space-x-4">
                                <!-- Wishlist -->
                                <a href="#" class="text-red-500 hover:text-red-700" data-toggle="wishlistcanvas"
                                    aria-label="View wishlist">
                                    <i class="fas fa-heart"></i>
                                </a>

                                <!-- Cart (with count, safe for guests) -->
                                <a href="#" class="relative text-brand hover:text-gray-900" data-toggle="cartcanvas"
                                    aria-label="View cart">
                                    <i class="fas fa-shopping-cart"></i>
                                    @if (auth()->check() && ($count = auth()->user()->carts()->count()) > 0)
                                        <span
                                            class="absolute -top-2 -right-2 flex h-5 w-5 items-center justify-center rounded-full bg-red-600 text-xs font-semibold text-white">
                                            {{ $count }}
                                        </span>
                                    @endif
                                </a>

                                <!-- Orders -->
                                <a href="#" class="text-brand hover:text-gray-900" data-toggle="ordercanvas"
                                    aria-label="View orders">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </a>
                            </div>
                            <div class="relative">
                                <button class="text-gray-700 hover:text-gray-900 font-medium flex items-center"
                                    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                    <i class="fas fa-chevron-down ml-1"></i>
                                </button>
                                <div class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50"
                                    id="dropdown-menu">
                                    <a href="{{ url('/profile') }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ __('Profile') }}</a>
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
<nav class="bg-pink-200 shadow-sm sticky top-0 z-40 text-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-3">
            <div class="flex items-center">
                <button id="menu-toggle" class="md:hidden text-gray-700 hover:text-gray-900"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <ul class="hidden md:flex space-x-4">
                    <li><a wire:navigate href="/all-products" class="text-gray-700 hover:text-gray-900 font-medium">All
                            Products</a></li>
                    <li><a wire:navigate href="/categories" class="text-gray-700 hover:text-gray-900 font-medium">Shop
                            by Category</a></li>
                    <li><a wire:navigate href="/women" class="text-gray-700 hover:text-gray-900 font-medium">Women</a>
                    </li>
                    <li><a wire:navigate href="/men" class="text-gray-700 hover:text-gray-900 font-medium">Men</a>
                    </li>
                </ul>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-phone text-gray-700"></i>
                <span class="text-gray-700">{{ config('contact.phone', '+91-1234567890') }}</span>
                <i class="fas fa-envelope text-gray-700"></i>
                <span class="text-gray-700">{{ config('contact.email', 'help.pagpriya@gmail.com') }}</span>

            </div>
        </div>
        <!-- Mobile Menu -->
        <div class="hidden md:hidden" id="mobile-menu">
            <ul class="flex flex-col space-y-2 p-4 bg-gray-50">
                <li><a wire:navigate href="/all-products" class="text-gray-700 hover:text-gray-900 font-medium">All
                        Products</a></li>
                <li><a wire:navigate href="/categories"
                        class="text-gray-700 hover:text-gray-900 font-medium">Categories</a></li>
                <li><a wire:navigate href="/women" class="text-gray-700 hover:text-gray-900 font-medium">Women</a></li>
                <li><a wire:navigate href="/men" class="text-gray-700 hover:text-gray-900 font-medium">Men</a></li>
            </ul>
        </div>
    </div>
</nav>
</header>

<!-- Orders Offcanvas -->
<div class="fixed inset-y-0 right-0 w-full sm:w-96 bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-50"
    id="ordercanvas" aria-labelledby="ordercanvas-title">
    <div class="flex flex-col h-full">
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold" id="ordercanvas-title">My Orders</h2>
            <button type="button" class="text-gray-700 hover:text-gray-900"
                onclick="document.getElementById('ordercanvas').classList.add('translate-x-full')"
                aria-label="Close orders">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-4">
            @if (Auth::user())
                @forelse(Auth::user()->orders as $order)
                    <div class="border border-gray-200 rounded-lg p-2 mb-2">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium">Order ID: #ORD{{ $order->id }}</span>
                            @if ($order->status == 'delivered')
                                <a href="{{ url('/pdf/' . $order->id) }}" target="_blank"
                                    class="inline-flex items-center px-3 py-1 bg-brand text-white text-sm rounded hover:bg-brand-hover transition">
                                    <i class="fa-regular fa-circle-down mr-1"></i> Download Invoice
                                </a>
                            @endif
                        </div>
                        @foreach ($order->orderDetails as $ordItm)
                            <div class="bg-white shadow-md rounded-lg mb-2 p-3 relative">
                                <a href="{{ url('product/' . $ordItm->product->id) }}"
                                    class="flex items-center text-gray-900 no-underline">
                                    <div class="w-1/3">
                                        <img src="{{ asset('storage/' . ($ordItm->product->images[0] ?? 'placeholder.png')) }}"
                                            alt="{{ $ordItm->product->name }}"
                                            class="w-full h-16 object-cover rounded">
                                    </div>
                                    <div class="w-2/3 pl-3">
                                        <p class="text-sm font-medium">{{ $ordItm->product->name }}</p>
                                        @php
                                            $price = isset($ordItm->product->productSize[0])
                                                ? $ordItm->product->productSize[0]->metal_price +
                                                    $ordItm->product->productSize[0]->gemstone_price +
                                                    $ordItm->product->productSize[0]->making_charges +
                                                    $ordItm->product->productSize[0]->gst
                                                : 0;
                                        @endphp
                                        <p class="text-sm">Rs. {{ $price }}</p>
                                    </div>
                                </a>
                                <div class="flex items-center space-x-2 absolute bottom-3 right-3">
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium rounded
                                            {{ $order->status == 'pending' ? 'bg-gray-500' : '' }}
                                            {{ $order->status == 'delivered' ? 'bg-green-500' : '' }}
                                            {{ $order->status == 'cancelled' ? 'bg-red-500' : '' }}
                                            {{ $order->status == 'shipped' ? 'bg-yellow-500' : '' }} text-white">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                    <a href="{{ url('review/' . $ordItm->product_id) }}"
                                        class="inline-flex items-center px-2 py-1 bg-brand text-white text-xs rounded hover:bg-brand-hover transition">
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
                        <a href="/all-product"
                            class="mt-3 inline-flex items-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-800 transition">Start
                            Shopping</a>
                    </div>
                @endforelse
            @endif
        </div>
    </div>
</div>

<!--Whishlist Canwas -->

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
            @if (Auth::user())
                @forelse(Auth::user()->wishlists as $wishlist)
                    <div class="bg-white shadow-md rounded-lg mb-3 p-3 relative">
                        <a href="{{ url('product/' . $wishlist->id) }}"
                            class="flex items-center text-gray-900 no-underline">
                            <div class="w-1/3">
                                <img src="{{ asset('storage/' . ($wishlist->product->images[0] ?? 'placeholder.png')) }}"
                                    alt="{{ $wishlist->product->name }}" class="w-full h-16 object-cover rounded">
                            </div>
                            <div class="w-2/3 pl-3">
                                <p class="text-sm font-medium">{{ $wishlist->product->name }}</p>
                                @php
                                    $price = isset($wishlist->product->productSize[0])
                                        ? $wishlist->product->productSize[0]->metal_price +
                                            $wishlist->product->productSize[0]->gemstone_price +
                                            $wishlist->product->productSize[0]->making_charges +
                                            $wishlist->product->productSize[0]->gst
                                        : 0;
                                @endphp
                                <p class="text-sm">Rs. {{ $price }}</p>
                            </div>
                        </a>
                        <button wire:click="removeFromWishlist({{ $wishlist->product_id }})"
                            class="absolute top-3 right-3 text-red-500 hover:text-red-700"
                            aria-label="Remove from wishlist">
                            <i class="fa-solid fa-heart"></i>
                        </button>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i class="fas fa-heart text-4xl text-gray-400 mb-2"></i>
                        <h3 class="text-lg font-semibold">No Items Added!</h3>
                        <a href="/shop-all"
                            class="mt-3 inline-flex items-center px-4 py-2 bg-brand text-white rounded hover:bg-brand-hover transition">Start
                            Shopping</a>
                    </div>
                @endforelse
            @endif
        </div>
    </div>
</div>
</div>

<!-- Cart Offcanvas -->
<div class="fixed inset-y-0 right-0 w-full sm:w-96 bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-50"
    id="cartcanvas" aria-labelledby="cartcanvas-title">
    <div class="flex flex-col h-full">
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold" id="cartcanvas-title">My Cart</h2>
            <button type="button" class="text-gray-700 hover:text-gray-900"
                onclick="document.getElementById('cartcanvas').classList.add('translate-x-full')"
                aria-label="Close cart">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-4">
            @if (Auth::user())
                @php
                    $tprice = 0;
                    $tdelivery = 0;
                @endphp
                @forelse(Auth::user()->carts as $cart)
                    <div class="bg-white shadow-md rounded-lg mb-3 p-3 relative"
                        id="cart-item-{{ $cart->product_id }}">
                        <a href="{{ url('product/' . $cart->id) }}"
                            class="flex items-center text-gray-900 no-underline">
                            <div class="w-1/3">
                                <img src="{{ asset('storage/' . ($cart->product->images[0] ?? 'placeholder.png')) }}"
                                    alt="{{ $cart->product->name }}" class="w-full h-16 object-cover rounded">
                            </div>
                            <div class="w-2/3 pl-3">
                                <p class="text-sm font-medium">{{ $cart->product->name }}</p>
                                @php
                                    $price = isset($cart->productSize)
                                        ? $cart->productSize->metal_price +
                                            $cart->productSize->gemstone_price +
                                            $cart->productSize->making_charges +
                                            $cart->productSize->gst
                                        : 0;
                                    $tprice += $price * $cart->quantity;
                                    $tdelivery += $cart->product->delivery_charge ?? 0;
                                @endphp
                                <div class="flex items-center mt-1">
                                    <span class="text-sm">Rs. {{ $cart->quantity * $price }}</span>
                                    <input type="number"
                                        wire:model.live.debounce.500ms="cart.{{ $cart->product_id }}.quantity"
                                        wire:change="updateQuantity({{ $cart->product_id }}, $event.target.value)"
                                        value="{{ $cart->quantity }}" min="1"
                                        class="ml-4 w-20 p-1 border border-gray-300 rounded text-sm focus:ring focus:ring-brand focus:border-brand">
                                </div>
                            </div>
                        </a>
                        <button wire:click="removeFromCart({{ $cart->product_id }})"
                            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
                            aria-label="Remove from cart">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i class="fas fa-shopping-cart text-4xl text-gray-400 mb-2"></i>
                        <h3 class="text-lg font-semibold">No Items Added!</h3>
                        <a href="/shop-all"
                            class="mt-3 inline-flex items-center px-4 py-2 bg-brand text-white rounded hover:bg-brand-hover transition">Start
                            Shopping</a>
                    </div>
                @endforelse
                @if (Auth::user()->carts->count() > 0)
                    <div class="bg-white shadow-md rounded-lg p-4 mt-4">
                        <h3 class="text-lg font-semibold text-center">Summary</h3>
                        <hr class="my-2 border-gray-200">
                        <p class="text-sm"><span class="font-medium">Price:</span> Rs. {{ $tprice }}</p>
                        <p class="text-sm"><span class="font-medium">Delivery Charge:</span> Rs. {{ $tdelivery }}
                        </p>
                        <hr class="my-2 border-gray-200">
                        <p class="text-sm"><span class="font-medium">Total:</span> Rs. {{ $tprice + $tdelivery }}</p>
                        <a href="/shop-all"
                            class="mt-3 w-full inline-flex justify-center items-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-800 transition">Shop
                            Now</a>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>

@livewireScripts
</body>

</html>
