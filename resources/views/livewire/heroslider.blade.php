<div>
@if(count($slides) > 0)

<div class="relative w-full h-screen overflow-hidden" 
     style="background-color: {{ $slides[$currentIndex]->bg_color ?? '#000' }}"
     wire:poll.5000ms="nextSlide">

    <!-- Image -->
    <div class="absolute inset-0">
        <img src="{{ asset('storage/'. $slides[$currentIndex]->image) }}" 
             class="w-full h-full object-cover transition duration-700 ease-in-out" 
             alt="Hero Slide">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    </div>

    <!-- Text Content -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-6">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">
            {{ $slides[$currentIndex]->text }}
        </h1>
        <p class="text-lg md:text-2xl mb-6">
            {{ $slides[$currentIndex]->description }}
        </p>
        <a wire:navigate href="/all-products" 
           class="bg-indigo-600 hover:bg-indigo-800 text-white px-6 py-3 rounded-lg shadow-lg transition">
           Explore Now
        </a>
    </div>

    <!-- Controls -->
    <div class="absolute inset-0 flex items-center justify-between px-6 z-20">
        <button wire:click="prevSlide" 
                class="bg-black bg-opacity-40 hover:bg-opacity-60 text-white p-3 rounded-full">
            &#8592;
        </button>
        <button wire:click="nextSlide" 
                class="bg-black bg-opacity-40 hover:bg-opacity-60 text-white p-3 rounded-full">
            &#8594;
        </button>
    </div>

    <!-- Dots -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20">
        @foreach($slides as $index => $slide)
            <button wire:click="$set('currentIndex', {{ $index }})"
                class="w-3 h-3 rounded-full {{ $currentIndex === $index ? 'bg-white' : 'bg-gray-400' }}">
            </button>
        @endforeach
    </div>
</div>
@endif
</div>