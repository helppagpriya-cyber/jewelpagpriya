@extends('layout.app')
@section('content')

<div class="container mx-auto my-2">
    <h2 class="text-center text-3xl font-bold">Shop Now</h2>
    <div class="container mx-auto my-3 bg-white shadow-md rounded-lg py-2">
        <h4 class="text-center text-xl font-semibold">User Details</h4>
        <form action="{{ url('shopNow') }}" method="POST">
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
                <div class="flex flex-wrap -mx-2">
                    @if($product->express_delivery_available)
                        <div class="w-full md:w-1/2 px-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_express_delivery" class="mr-2 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"/>
                                Express Delivery
                            </label>
                            <p class="text-sm"><b>Express Delivery Charge : </b>{{ $product->express_delivery_charge }}</p>
                        </div>
                    @endif
                    <div class="w-full md:w-1/6 px-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_gifted" class="mr-2 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"/>
                            Gift Someone Special
                        </label>
                        <p class="text-sm"><b>Free (No Charge)</b></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap -mx-2">
            <div class="container mx-auto my-3 bg-white shadow-md rounded-lg py-2">
                <h4 class="text-center text-xl font-semibold">Product Details</h4>
                @if(auth()->user()->orders->count() == 0)
                    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                        Congrats 🎉!! This will be your first order, You will get Rs. 5000 off on first order item !!🥳
                    </div>
                @endif
                <div class="flex flex-wrap py-2">
                    <input type="hidden" name="product_id" value="{{ $product->id }}" id="productId">
                    <div class="w-full sm:w-1/4 px-2">
                        <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-[200px] object-cover rounded">
                    </div>
                    <div class="w-full sm:w-3/4 px-3">
                        <h5 class="text-lg font-semibold">{{ $product->name }}</h5>
                        <div class="flex flex-wrap -mx-2">
                            <div class="w-full md:w-1/2 px-2">
                                <label class="block text-sm font-medium text-gray-700">Size <span class="text-red-500">*</span></label>
                                <select class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="sizeSelect" name="product_size">
                                    <option value="">Select Size</option>
                                    @foreach($product->productSizes as $size)
                                        <option value="{{ $size->size }}">{{ $size->size }}</option>
                                    @endforeach
                                </select>
                                @error('product_size')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2 px-2">
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity <span class="text-red-500">*</span></label>
                                <input type="number" class="quantity-selector block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="1" id="quantity" name="quantity">
                                @error('quantity')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>
                            @if(auth()->user()->orders->count() == 0)
                                <b class="w-full px-2">You will get Rs. 5000 off in mentioned price !!</b>
                            @endif
                            <p class="w-full px-2 text-sm" id="productSizePrice"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="bg-[#5C3422] text-white px-4 py-2 rounded block mx-auto hover:bg-[#4a2b1b]">Shop Now</button>
    </form>
</div>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#sizeSelect').on('change', function() {
            var productId = $('#productId').val();
            var size = $(this).val();
            $.ajax({
                url: '/productsize/' + productId + '/' + size,
                type: 'GET',
                success: function(response) {
                    $('#productSizePrice').html('Price : Rs.' + response + ' /Pc');
                },
                error: function(error) {
                    alert('Error in removing product.... !');
                }
            });
        });
    });
</script>