
   <div class="p-4">

    <h2 class="text-xl font-bold mb-4">Vendor Cart</h2>

    @if(session()->has('error'))
        <div class="bg-red-200 p-2 mb-3">{{ session('error') }}</div>
    @endif

    <table class="w-full border">
        <tr class="bg-gray-200">
            <th class="text-left py-2 px-2">Product Name</th>
            <th class="text-left py-2">Image</th>
            <th class="text-center py-2">Weight</th>
            <th class="text-right py-2">Rate</th>
            <th class="text-center py-2">Qty</th>
            <th class="text-right py-2">Making</th>
            <th class="text-right py-2">Total</th>
            <th class="text-right py-2 px-2">Action</th>
        </tr>

        @foreach($cart as $id => $item)
        <tr>
            <td class="text-left px-2">{{ $item['name'] }}</td>
            <td class="py-2"><img src="{{ url('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-14 h-14 border shadow"></td>
            <td class="text-center">{{ $item['weight'] ?? 0 }} gm</td>
            <td class="text-right">₹{{ $item['rate'] ?? 0 }}</td>
            <td class="text-center">
                <input type="number"
                       wire:change="updateQty({{ $id }}, $event.target.value)"
                       value="{{ $item['quantity'] ?? 1}}"
                       min="1"
                       class="border-white w-16 ml-4">
            </td>
            <td class="text-right">₹{{ $item['making_charges'] ?? 0 }}</td>
            <td class="text-right">
               ₹{{
        (($item['weight'] ?? 0) *
         ($item['rate'] ?? 0) *
         ($item['quantity'] ?? 1))
        +
        (($item['making_charges'] ?? 0) *
         ($item['quantity'] ?? 1))
    }}
            </td>
            <td class="text-right px-2">
                <button wire:click="removeItem({{ $id }})"
                        class="bg-red-600 rounded-sm py-1 px-1 text-white">Remove</button>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="mt-4 text-right font-bold">
        Grand Total: ₹{{ $this->total }}
    </div>

    <div class="mt-4 text-right">
        <button wire:click="submitOrder"
                class="bg-green-600 text-white px-4 py-2 rounded">
            Submit Order For Approval
        </button>
    </div>

</div>
