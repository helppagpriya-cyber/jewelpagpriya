<footer class="py-5 text-white bg-pink-400">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div>
                <h5 class="text-lg font-semibold mb-2">
                    <a href="#" class="inline-block">
                        <img src="{{ asset('image/light-logo.png') }}" height="40" alt="Logo" />
                    </a>
                </h5>
                <p class="text-sm">PAGPRIYA by Ojas Jewel Emporium<br>3013-15-A, First Floor, Gali No. 19 Ranjit Nagar, New Delhi-110008</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-2">Categories</h2>
                 <div class="flex flex-wrap gap-2">
                <ul class="space-y-2">
                    <li class="bg-white text-black px-2 py-1 rounded text-sm hover:bg-green-400"><a href="{{ url('subcategory/1') }}" >Rings</a></li>
                    <li class="bg-white text-black px-2 py-1 rounded text-sm hover:bg-green-400"><a href="{{ url('subcategory/6') }}" >Necklace</a></li>
                    <li class="bg-white text-black px-2 py-1 rounded text-sm hover:bg-green-400"><a href="{{ url('subcategory/4') }}" >Earings</a></li>
                </ul>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-2">Occasions</h2>
                <div class="flex flex-wrap gap-2">
                    <ul>
                    <li class="bg-white text-black px-2 py-1 rounded text-sm mb-2">Wedding</li>
                    <li class="bg-white text-black px-2 py-1 rounded text-sm mb-2">Engagement</li>
                    <li class="bg-white text-black px-2 py-1 rounded text-sm mb-2">Regular Wear</li>
                    <li class="bg-white text-black px-2 py-1 rounded text-sm mb-2">Festival</li>
                    </ul>
                </div>
            </div>

            <div class="h-48">
                <iframe src=""
                    class="w-full h-full border border-white rounded"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</footer>
<div class="text-center py-4 text-white bg-gray-500">
    &copy; {{ date('Y') }} PAGPRIYA by Ojas Jewel Emporium. All rights reserved.
</div>