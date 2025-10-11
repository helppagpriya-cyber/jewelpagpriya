@extends('layout.app')
@section('content')

    <div class="container mx-auto my-2">
        <h2 class="text-center text-3xl font-bold">Order Cart Items</h2>
        <div class="container mx-auto my-3 bg-white shadow-md rounded-lg py-2">
            <h4 class="text-center text-xl font-semibold">User Details</h4>
            <form action="{{ url('shopAll') }}" method="POST">
                @csrf

                <div class="flex flex-wrap -mx-2">
                    <div class="w-full md:w-1/2 px-2 mb-3">
                        <label for="payment_mode" class="block text-sm font-medium text-gray-700">Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ auth()->user()->name }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('name')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-2 mb-3">
                        <label for="payment_mode" class="block text-sm font-medium text-gray-700">Payment Mode <span class="text-red-500">*</span></label>
                        <select id="payment_mode" name="payment_mode" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="COD">Cash on Delivery</option>
                        </select>
                        @error('payment_mode')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="w-full px-2">
                        <p class="text-sm font-medium">Select Address <span class="text-red-500">*</span></p>
                        @foreach(auth()->user()->userAddresses as $k => $add)
                            <div class="mb-3 w-full md:w-1/2 mx-auto border border-gray-300 rounded-md p-2">
                                <input type="radio" name="address" value="{{ $add->id }}" id="address_{{ $add->id }}" {{ $k == 0 ? 'checked' : '' }} class="mr-2">
                                <label for="address_{{ $add->id }}" class="flex text-sm font-medium text-gray-700"> {!! $add->address !!}, {{ $add->city }}, {{ $add->state }}, {{ $add->pin }} , <b class="ml-1">Mo:</b> {{ $add->phone }}</label>
                            </div>
                        @endforeach
                        @error('address')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="container mx-auto my-3 bg-white shadow-md rounded-lg py-2">
                <h4 class="text-center text-xl font-semibold">Cart Details</h4>
                @if(auth()->user()->orders->count() == 0)
                    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                        Congrats 🎉!! This will be your first order, You will get Rs. 5000 off on first order item !!🥳
                    </div>
                @endif
                @foreach(auth()->user()->carts as $key => $cartItem)
                    <div class="flex flex-wrap py-2">
                        <input type="hidden" name="product_id[]" value="{{ $cartItem->product_id }}">
                        <div class="w-full sm:w-1/4 px-2">
                            <img src="{{ asset('storage/' . $cartItem->product->images[0]) }}" alt="{{ $cartItem->product->name }}" class="w-full h-[200px] object-cover rounded">
                        </div>
                        <div class="w-full sm:w-3/4 px-3">
                            <h5 class="text-lg font-semibold">{{ $cartItem->product->name }}</h5>
                            <div class="flex flex-wrap -mx-2">
                                <input type="hidden" class="product-id" value="{{ $cartItem->product_id }}">
                                <input type="hidden" class="index" value="{{ $key }}">
                                <div class="w-full md:w-1/2 px-2">
                                    <label class="block text-sm font-medium text-gray-700">Size <span class="text-red-500">*</span></label>
                                    <select class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="product_size[]">
                                        <option value="">Select Size</option>
                                        @foreach($cartItem->product->productSizes as $size)
                                            <option value="{{ $size->id }}" {{ $cartItem->product_size_id == $size->id ? 'selected' : '' }}>{{ $size->size }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_size')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="w-full md:w-1/2 px-2">
                                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity <span class="text-red-500">*</span></label>
                                    <input type="number" class="quantity-selector block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $cartItem->quantity }}" name="quantity[]">
                                    @error('quantity')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                @if(auth()->user()->orders->count() == 0)
                                    <b class="w-full px-2">You will get Rs. 5000 off in mentioned price !!</b>
                                @endif
                                <p class="card-text w-full px-2" id="productSizePrice{{ $key }}">Price : Rs. {{ $cartItem->productSize->metal_price + $cartItem->productSize->gemstone_price + $cartItem->productSize->making_charges + $cartItem->productSize->gst }} /Pc</p>
                            </div>
                            <div class="flex flex-wrap -mx-2 my-2">
                                <div class="w-full md:w-1/2 px-2">
                                    <label class="flex items-center {{ $cartItem->product->express_delivery_available == 0 ? 'line-through' : '' }}">
                                        <input type="checkbox" name="is_express_delivery[{{ $key }}]" class="form-check mr-2 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" {{ $cartItem->product->express_delivery_available == 0 ? 'disabled' : '' }}>
                                        Express Delivery
                                    </label>
                                    <p class="text-sm"><b>Express Delivery Charge : </b>Rs. {{ $cartItem->product->express_delivery_charge ?? '' }}</p>
                                </div>
                                <div class="w-full md:w-1/2 px-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="is_gifted[{{ $key }}]" class="form-check mr-2 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                        Gift Someone Special
                                    </label>
                                    <p class="text-sm"><b>Free (No Charge)</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="bg-[#5C3422] text-white px-4 py-2 rounded block mx-auto mb-3 hover:bg-[#4a2b1b]" {{ auth()->user()->carts()->count() == 0 ? 'disabled' : '' }}>Order All Items</button>
        </form>
    </div>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('select[name="product_size[]"]').on('change', function() {
            var productId = $(this).closest('.row').find('.product-id').val();
            var size = $(this).val();
            var index = $(this).closest('.row').find('.index').val();
            $.ajax({
                url: '/productsize/' + productId + '/' + size,
                type: 'GET',
                success: function(response) {
                    $('#productSizePrice' + index).html('Price : Rs.' + response + ' /Pc');
                },
                error: function(error) {
                }
            });
        });
    });
</script>