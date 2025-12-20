<div class="container mx-auto">
    <h3 class="text-center text-2xl font-bold">Review Product</h3>

    <div class="flex flex-wrap -mx-2">
        <!-- Product Details -->
        <div class="w-full md:w-1/3 px-2">
            <div class="bg-white shadow-md rounded-lg mx-1 mb-1 p-1">
                <a wire:navigate href="{{ url('product/' . $product->id) }}"
                    class="no-underline text-gray-900 flex w-full">
                    <div class="w-5/12">
                        <img src="{{ asset('storage/' . $product->images[0]) }}"
                            class="w-full h-[150px] object-cover rounded" alt="Product image">
                    </div>
                    <div class="w-7/12 p-0 m-0">
                        <p class="text-left">{{ $product->name }}</p>
                        <div class="flex items-center m-0 p-0">
                            <span> ₹{{ $price }}</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Review Form -->
        <div class="w-full md:w-2/3 px-2">
            <div class="bg-white shadow-md rounded-lg mx-1 mb-1 p-1">
                <form wire:submit="submitReview">
                    <div class="flex flex-wrap -mx-2">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="w-full md:w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700">Rating</label>
                            <select wire:model.live="rating"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="1">Very Bad</option>
                                <option value="2">Bad</option>
                                <option value="3">Ok OK</option>
                                <option value="4">Good</option>
                                <option value="5">Very Good</option>
                            </select>
                            @error('rating')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="w-full md:w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700">Comment</label>
                            <textarea wire:model.live="comment"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                            @error('comment')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="w-full px-2">
                            <label class="block text-sm font-medium text-gray-700">Image</label>
                            <input type="file" wire:model="image"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                            @if ($imagePreview)
                                <div class="mt-3">
                                    <p class="text-sm text-gray-600">Preview:</p>
                                    <img src="{{ $imagePreview }}" class="w-32 h-32 object-cover rounded mt-2"
                                        alt="Preview">
                                </div>
                            @endif

                            @error('image')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit"
                            class="bg-[#5C3422] text-white px-4 py-2 rounded mx-auto my-3 hover:bg-[#4a2b1b]">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="mt-4 text-center text-green-600">
            {{ session('success') }}
        </div>
    @endif
</div>
