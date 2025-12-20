<div>

    <footer class="py-5 text-white bg-pink-400">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <h5 class="text-lg font-semibold mb-2">
                        <a wire:navigate href="/" class="inline-block">
                            <img src="{{ asset('image/light-logo.png') }}" height="40" alt="Logo" />
                        </a>
                    </h5>
                    <p class="text-sm">PAGPRIYA by Ojas Jewel Emporium<br>3013-15-A, First Floor, Gali No. 19 Ranjit
                        Nagar,
                        New Delhi-110008</p>
                </div>

                <div>
                    <h2 class="text-lg font-semibold mb-2">Categories</h2>
                    @foreach ($categories as $category)
                        <div class="flex flex-wrap gap-2">
                            <ul class="space-y-2">
                                <li class="text-sm hover:underline"><a wire:navigate
                                        href="{{ url('subcategory/' . $category->category_id) }}">{{ $category->name }}</a>
                                </li>

                            </ul>
                        </div>
                    @endforeach
                </div>
                <div>
                    <h2 class="text-lg font-semibold mb-2">Occasions</h2>
                    @foreach ($occasions as $occasion)
                        <div class="flex flex-wrap gap-2">
                            <ul>
                                <li class="text-sm mb-2">{{ $occasion->name }}</li>

                            </ul>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 md:mt-0">
                    <h4 class="font-bold mb-2">Our Policies</h4>

                    {{-- @if ($policies->count())
                        <ul class="space-y-1 text-sm">
                            @foreach ($policies as $policy)
                                <li>
                                    <a href="{{ route('policy.show', $policy->slug) }}" class="hover:underline">
                                        {{ $policy->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>All policies will update shortly.</p>
                    @endif --}}
                </div>
            </div>
        </div>
        <div class="text-sm mt-4 border">
            <p class="text-justify px-2 py-2">Silver Jewellery Collection
                Silver Jewellery| Sterling Silver | 925 Sterling Silver | Silver Jewellery Online | 925 Silver | Silver
                Jewellery Shopping | Silver Shop | Pure Silver | Silver Pendant | Fine Silver Jewellery | Silver
                Necklace
                Set | The Silver Shop | Real Silver Jewellery | Silver Accessories | Pure Silver Indian Jewellery Online
                |
                Silver Jewellery | Silver Jewellery Sets | Sterling Silver Jewellery Online | Silver Jewellery Shopping
                Online | Sterling Jewellery | Pure Silver Jewellery | Cheap Silver Jewellery | Silver Necklace And
                Earring
                Set | 925 Jewellery | Silver Store | Silver 925 Jewellery | Silver Jewellery Online India | Online
                Silver
                Jewellery | Silver Jewelry | Silver Jewellery Shop Near Me | Online Silver Shopping | Unique Silver
                Jewellery | Solid Silver Jewellery | Silver Shop Online | Gold And Silver Jewellery | Sterling Silver
                Necklace And Earring Set | Sterling Silver Jewellery Sets | Silver And Gold Jewellery | Pure Silver
                Jewellery Cheap Sterling Silver Jewellery Buy Silver Jewellery |Sterling Silver Jewellery Online | The
                Silver Collection | Gold And Silver Necklace Together | Gold And Silver Earrings Together | Sterling
                Silver
                Jewelry | Sterling Silver Fine Jewellery | Best Place To Buy Silver Jewellery | 925 Sterling Silver
                Jewellery | Earring And Necklace Set Silver | Anti tarnish jewellery | Shop by budget

                Silver Jewellery for Women
                Necklace For Women Silver | 925 Sterling Silver Necklace | Sterling Silver Necklace Set | Silver
                Ornaments
                Online | Sterling Silver Jewellery | Silver Pendant For Women | Sterling Silver Women's Jewellery | Buy
                Silver Earrings Online | Buy Silver Necklace | Silver Necklace And Bracelet Set | Sterling Silver
                Necklace
                And Bracelet Set | Silver Jewellery Necklace | Silver Necklace And Earrings

                Silver Jewellery for Men
                Silver Chain Set | Silver Chain And Bracelet Set | Men's Jewellery Online | Silver Accessories For Men |
                Jewels For Men | 92.5 Silver

                Silver Jewellery for Kids
                Nazariya | Silver Kids Jewellery | New Born Kada | Baby Jewellery | Kids Locket | Girls Anklets | Kids
                jewellery
            </p>
        </div>
    </footer>
    <div class="text-center py-4 text-white bg-gray-500">
        &copy; {{ date('Y') }} PAGPRIYA. All rights reserved.
    </div>
</div>
