<div class="container mx-auto my-2">
    <h2 class="text-center text-3xl font-bold">PLACE YOUR ORDER</h2>

    <form wire:submit.prevent="placeOrder" class="space-y-6">

        {{-- USER DETAILS --}}
        <div class="bg-white shadow-md rounded-lg py-2 px-4">
            <h4 class="text-center text-xl font-semibold">User Details</h4>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           value="{{ auth()->user()->name }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           disabled>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Payment Mode <span class="text-red-500">*</span>
                    </label>
                    <select wire:model.live="paymentMode"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="ONLINE">ONLINE PAYMENT</option>
                        <option value="COD">CASH ON DELIVERY</option>
                    </select>
                    @error('paymentMode') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-4">
                <p class="text-sm font-medium">Select Address <span class="text-red-500">*</span></p>
                <div class="space-y-2">
                    @foreach(auth()->user()->userAddresses as $addr)
                        <label class="flex items-center border border-gray-300 rounded-md p-2 cursor-pointer">
                            <input type="radio"
                                   wire:model.live="wAddressId"
                                   value="{{ $addr->id }}"
                                   class="mr-2">
                            <span class="text-sm font-medium text-gray-700">
                                {!! $addr->address !!}, {{ $addr->city }}, {{ $addr->state }}, {{ $addr->pin }} ,
                                <b class="ml-1">Mob:</b> {{ $addr->phone }}
                            </span>
                        </label>
                    @endforeach
                </div>
                @error('selectedAddressId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- CART DETAILS --}}
        <div class="bg-white shadow-md rounded-lg py-2 px-4">
            <h4 class="text-center text-xl font-semibold">Cart Details</h4>

            @if($isFirstOrder)
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 mb-4 rounded">
                    Congrats! This will be your first order – you get **Rs. 50/- off** on each item!
                </div>
            @endif

            @forelse($cartItems as $index => $cart)
                <div class="flex flex-col md:flex-row py-4 border-b last:border-0">
                    <input type="hidden" wire:model="cartItems.{{ $index }}.product_id">

                    <div class="md:w-1/4 px-2">
                        <img src="{{ asset('storage/' . $cart->product->images[0]) }}"
                             alt="{{ $cart->product->name }}"
                             class="w-full h-48 object-cover rounded">
                    </div>

                    <div class="md:w-3/4 px-3 space-y-3">
                        <h5 class="text-lg font-semibold">{{ $cart->product->name }}</h5>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Size --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Size <span class="text-red-500">*</span>
                                </label>
                                <select wire:model.live="selectedSizes.{{ $index }}"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">Select Size</option>
                                    @foreach($cart->product->productSizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->size }}</option>
                                    @endforeach
                                </select>
                                @error("selectedSizes.{$index}") <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            {{-- Quantity --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Quantity <span class="text-red-500">*</span>
                                </label>
                                <input type="number"
                                       wire:model.live="quantities.{{ $index }}"
                                       min="1"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error("quantities.{$index}") <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        @if($isFirstOrder)
                            <p class="text-sm font-semibold text-green-600">
                                You will get Rs. 50/- off on this item!
                            </p>
                        @endif

                        <p class="text-sm">
                            Price: <strong>Rs. {{ $sizePrices[$index] ?? 0 }} /Pc</strong>
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                            {{-- Express Delivery --}}
                            <div>
                                <label class="flex items-center {{ $cart->product->express_delivery_available ? '' : 'line-through' }}">
                                    <input type="checkbox"
                                           wire:model.live="express.{{ $index }}"
                                           {{ $cart->product->express_delivery_available ? '' : 'disabled' }}
                                           class="mr-2 h-4 w-4 text-indigo-600 rounded">
                                    Express Delivery
                                </label>
                                @if($cart->product->express_delivery_available)
                                    <p class="text-xs"><b>Charge:</b> Rs. {{ $cart->product->express_delivery_charge }}</p>
                                @endif
                            </div>

                            {{-- Gift Option --}}
                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox"
                                           wire:model.live="gift.{{ $index }}"
                                           class="mr-2 h-4 w-4 text-indigo-600 rounded">
                                    Gift Someone Special
                                </label>
                                <p class="text-xs"><b>May Charges apply</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 py-4">Your cart is empty.</p>
            @endforelse
        </div>

        <button type="submit"
                class="bg-green-600 hover:bg-green-800 text-white px-6 py-2 rounded block mx-auto mt-4"
                {{ $cartItems ? '' : 'disabled' }}>
            Place Your Order
        </button>
    </form>
</div>