<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Wholesale Product Selection</h1>

    <div class="flex justify-between items-center mb-6">
        <div>
            <button wire:click="toggleMode" class="bg-indigo-600 text-white px-6 py-3 rounded-lg">
                Switch to {{ $mode === 'amount' ? 'Metal' : 'Amount' }} Mode
                (Current: {{ ucfirst($mode) }})
            </button>
        </div>
        <div class="text-lg">
            Min: {{ $minWeight }}g | Max: {{ $maxWeight }}g
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="addToCart">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left">Select</th>
                        <th class="py-3 px-4 text-left">Image</th>
                        <th class="py-3 px-4 text-left">Name</th>
                        <th class="py-3 px-4 text-left">Weight (g)</th>
                        <th class="py-3 px-4 text-left">Silver Rate</th>
                        <th class="py-3 px-4 text-left">Labour Rate</th>
                        <th class="py-3 px-4 text-left">Quantity</th>
                        <th class="py-3 px-4 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        @php
                            $size = $product->productSize->first();
                            $metalWeight = $size?->metal_weight ?? 0;
                            $quantity = $selected[$product->id] ?? 0;
                            $ratePerGram = $silverRate + $labourRate;
                            $rowAmount = $mode === 'amount' ? $ratePerGram * $metalWeight * $quantity : 0;
                        @endphp

                        <tr class="border-t hover:bg-gray-50">
                            <td class="py-4 px-4">
                                <input type="checkbox" wire:model.live="selected.{{ $product->id }}" value="1"
                                    class="w-5 h-5">
                            </td>
                            <td class="py-4 px-4">
                                <img src="{{ asset('storage/' . ($product->images[0] ?? 'default.jpg')) }}"
                                    alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                            </td>
                            <td class="py-4 px-4 font-medium">{{ $product->name }}</td>
                            <td class="py-4 px-4">{{ number_format($metalWeight, 3) }} gm</td>
                            <td class="py-4 px-4">₹ {{ number_format($silverRate, 2) }}/gm</td>
                            <td class="py-4 px-4">₹ {{ number_format($labourRate, 2) }}/gm</td>
                            <td class="py-4 px-4">
                                <input type="number" min="1" max="50"
                                    wire:model.live="selected.{{ $product->id }}"
                                    class="w-20 border rounded px-2 py-1 text-center" placeholder="1">
                            </td>
                            <td class="py-4 px-4 text-right font-semibold">
                                @if ($mode === 'amount')
                                    ₹ {{ number_format($ratePerGram * $metalWeight * $quantity, 2) }}
                                @else
                                    ₹ {{ number_format($labourRate * $metalWeight * $quantity, 2) }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <!-- Grand Total Row -->
                <tfoot class="bg-gray-200 font-bold">
                    <tr>
                        <td colspan="3" class="py-4 px-4 text-right text-lg">Total Weight:</td>
                        <td class="py-4 px-4 text-right text-lg text-blue-700">
                            {{ number_format(
                                collect($products)->sum(function ($product) use ($selected) {
                                    $size = $product->productSize->first();
                                    $metalWeight = $size?->metal_weight ?? 0;
                                    $quantity = $selected[$product->id] ?? 0;
                                    return $metalWeight * $quantity;
                                }),
                                3,
                            ) }}
                            gm
                        </td>
                        <td colspan="3" class="py-4 px-4 text-right text-lg">Total Amount:</td>
                        <td class="py-4 px-4 text-right text-green-700 text-lg">
                            @if ($mode === 'amount')
                                ₹
                                {{ number_format(
                                    collect($products)->sum(function ($product) use ($selected, $silverRate, $labourRate) {
                                        $size = $product->productSize->first();
                                        $metalWeight = $size?->metal_weight ?? 0;
                                        $quantity = $selected[$product->id] ?? 0;
                                        return ($silverRate + $labourRate) * $metalWeight * $quantity;
                                    }),
                                    2,
                                ) }}
                            @else
                                ₹
                                {{ number_format(
                                    collect($products)->sum(function ($product) use ($selected, $silverRate, $labourRate) {
                                        $size = $product->productSize->first();
                                        $metalWeight = $size?->metal_weight ?? 0;
                                        $quantity = $selected[$product->id] ?? 0;
                                        return $labourRate * $metalWeight * $quantity;
                                    }),
                                    2,
                                ) }}
                            @endif
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @error('weight')
            <span class="text-red-600 block mt-4">{{ $message }}</span>
        @enderror
        @error('selected')
            <span class="text-red-600 block mt-4">{{ $message }}</span>
        @enderror

        <div class="mt-8">
            <button type="submit" class="bg-green-600 text-white px-8 py-4 text-lg rounded-lg hover:bg-green-700">
                Add Selected to Cart
            </button>
        </div>
    </form>
</div>
