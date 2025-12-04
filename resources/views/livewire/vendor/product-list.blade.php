<div>
   <div class="p-4">

    <h2 class="text-xl font-bold mb-3">Select Products</h2>
    <div class="flex justify-end mb-3">
    <a wire:navigate href="{{ route('vendor.cart') }}"
       class="bg-green-600 text-white px-4 py-2 rounded">
        Go To Cart
    </a>
    {{-- Filters --}}
    <div class="grid grid-cols-4 gap-3 mb-4">

        <select wire:model="category" class="border p-2 rounded">
            <option value="">All Categories</option>
            @foreach($category as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>

        <input type="number" wire:model="minWeight" placeholder="Min Weight"
               class="border p-2 rounded">

        <input type="number" wire:model="maxWeight" placeholder="Max Weight"
               class="border p-2 rounded">

        <input type="text" wire:model="search" placeholder="Search Product"
               class="border p-2 rounded">

    </div>

    {{-- Product List --}}
    <div class="grid grid-cols-4 gap-4">

        @foreach($products as $product)
        
        <div class="border rounded p-4 shadow">
            <div class="flex gap-4">
            <h3 class="font-bold">{{ $product->name }}</h3>
            <img class="border rounded w-16 h-16" src="{{ url('storage/' . $product->images[0]) }}" alt="">
            </div>

            <div class="text-sm text-gray-600">
                @foreach($productsize as $size)
                Weight: {{ $size->metal_weight }} gm <br>

                Making: ₹{{ $size->making_charges }}
                @endforeach
            </div>

            <div class="mt-2 ">
                <input type="number"
                        value="1"
                        min="1"
                       wire:model.defer="quantity.{{ $product->id }}"
                       class="w-20"
                       >
            </div>

            <button wire:click="addToCart({{ $product->id }})"
                    class="bg-green-600 text-white px-3 py-1 rounded mt-3">
                Add to Cart
            </button>

        </div>
        @endforeach
            
</div>

    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>

</div>


<script>
document.addEventListener('livewire:initialized', () => {
    Livewire.on('cart-added', (data) => {
        alert(data.name + ' added to cart successfully!');
    });
});
</script>
</div>
