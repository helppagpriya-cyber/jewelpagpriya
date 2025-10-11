<footer class="py-5 text-white" style="background-color: #3D281C">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div>
                <h5 class="text-lg font-semibold mb-2">
                    <a href="#" class="inline-block">
                        <img src="{{ asset('image/light-logo.png') }}" height="40" alt="Logo" />
                    </a>
                </h5>
                <p class="text-sm">"LUXORA by Ojas Jewel Jewellers", 125, Subhash Nagar, Near Jubilee Garden, Rajkot, Gujarat 360001</p>
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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29537.954953993132!2d70.78187451546843!3d22.26873120136533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959ca7ecb46581f%3A0x8c56f6448dde780d!2sBhakti%20Nagar%2C%20Rajkot%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1742533470265!5m2!1sen!2sin"
                    class="w-full h-full border border-white rounded"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</footer>
<div class="text-center py-4 text-white" style="background-color: #2C1E16">
    &copy; {{ date('Y') }} LUXORA by Ojas Jewel Jewellers. All rights reserved.
</div>