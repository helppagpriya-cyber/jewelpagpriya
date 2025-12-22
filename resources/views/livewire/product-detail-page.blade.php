<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

        <div class="space-y-4">
            <div x-data="{ activeSlide: 0, slides: {{ json_encode($this->product->images) }} }" class="relative overflow-hidden rounded-2xl bg-gray-100 aspect-square">
                <template x-for="(image, index) in slides" :key="index">
                    <div x-show="activeSlide === index" class="absolute inset-0 transition-opacity duration-500">
                        <img :src="'/storage/' + image" class="w-full h-full object-contain">
                    </div>
                </template>

                <button @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1"
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 p-2 rounded-full shadow-md hover:bg-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <button @click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1"
                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 p-2 rounded-full shadow-md hover:bg-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex flex-col">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">{{ $this->product->name }}</h1>

            <div class="prose prose-sm text-gray-600 mb-6">
                {!! $this->product->description !!}
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Select Size</label>
                <select wire:model.live="selectedSizeId"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                    @foreach ($this->product->productsize as $size)
                        <option value="{{ $size->id }}">{{ $size->size }}</option>
                    @endforeach
                </select>
            </div>

            <div class="bg-gray-50 p-6 rounded-xl mb-8">
                <div class="flex items-center gap-4">
                    <span
                        class="text-4xl font-bold text-red-600">₹{{ number_format($this->priceDetails['final']) }}</span>
                    @if ($this->priceDetails['discount'])
                        <span
                            class="text-xl text-gray-400 line-through">₹{{ number_format($this->priceDetails['base']) }}</span>
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm font-bold">
                            ₹{{ $this->priceDetails['discount']->discount }} OFF
                        </span>
                    @endif
                </div>
                <p class="text-xs text-gray-500 mt-2">Inclusive of all taxes</p>
            </div>

            <div class="flex gap-4">
                <div class="w-32">
                    <input type="number" wire:model.live="quantity" min="1" max="5"
                        class="w-full border-gray-300 rounded-lg text-center">
                </div>
                <button wire:click="addToCart"
                    class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 rounded-lg transition-all transform active:scale-95">
                    ADD TO CART
                </button>
                <button wire:click="buynow({{ $this->product->id }})"
                    class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-lg transition-all transform active:scale-95">
                    BUY NOW
                </button>
            </div>

            <div class="mt-10 border-t pt-8">
                <h3 class="text-lg font-bold mb-4">Product Specifications</h3>
                <div class="grid grid-cols-2 gap-y-4 text-sm">
                    <div class="text-gray-500">Metal</div>
                    <div class="font-semibold">{{ $this->product->metal->name ?? 'N/A' }}</div>

                    <div class="text-gray-500">Purity</div>
                    <div class="font-semibold">{{ $this->selectedSize->metal_purity ?? 'N/A' }}</div>

                    <div class="text-gray-500">Occasion</div>
                    <div class="font-semibold">{{ $this->product->occasion->name ?? 'General' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
