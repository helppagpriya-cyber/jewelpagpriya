<footer class="py-5 text-white bg-pink-400">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div>
                <h5 class="text-lg font-semibold mb-2">
                    <a href="#" class="inline-block">
                        <img src="{{ asset('image/light-logo.png') }}" height="40" alt="Logo" />
                    </a>
                </h5>
                <p class="text-sm">LUXORA by Ojas Jewel Emporium<br>3013-15-A, First Floor, Gali No. 19 Ranjit Nagar, New Delhi-110008</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-2">Categories</h2>
                <ul class="space-y-1">
                    <li><a href="{{ url('subcategory/1') }}" class="block text-white hover:underline">Rings</a></li>
                    <li><a href="{{ url('subcategory/6') }}" class="block text-white hover:underline">Necklace</a></li>
                    <li><a href="{{ url('subcategory/4') }}" class="block text-white hover:underline">Earings</a></li>
                </ul>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-2">Occasions</h2>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-white text-black px-2 py-1 rounded text-sm">Wedding</span>
                    <span class="bg-white text-black px-2 py-1 rounded text-sm">Engagement</span>
                    <span class="bg-white text-black px-2 py-1 rounded text-sm">Regular Wear</span>
                    <span class="bg-white text-black px-2 py-1 rounded text-sm">Festival</span>
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
    &copy; {{ date('Y') }} LUXORA by Ojas Jewel Emporium. All rights reserved.
</div>