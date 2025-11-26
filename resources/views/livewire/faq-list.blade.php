<div class="max-w-2xl mx-auto my-10">
    <h2 class="text-2xl font-bold mb-6">Frequently Asked Questions</h2>

    @foreach($faqs as $faq)
        <div class="border-b py-4">
            <!-- Question -->
            <button 
                wire:click="toggle({{ $faq->id }})" 
                class="flex justify-between items-center w-full text-left focus:outline-none"
            >
                <span class="text-lg font-medium">{{ $faq->question }}</span>
                <span class="ml-2 text-xl">
                    @if($openFaq === $faq->id)
                        −
                    @else
                        +
                    @endif
                </span>
            </button>

            <!-- Animated Answer -->
            <div 
                class="overflow-hidden transition-all duration-300 ease-in-out"
                style="{{ $openFaq === $faq->id ? 'max-height: 200px; opacity: 1;' : 'max-height: 0; opacity: 0;' }}"
            >
                <p class="mt-2 text-gray-600">
                    {{ $faq->answer }}
                </p>
            </div>
        </div>
    @endforeach
</div>
