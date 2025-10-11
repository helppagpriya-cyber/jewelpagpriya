<div class="container mx-auto my-3">
    @if(session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-2" role="alert">
            {{ session('success') }}
            <button type="button" class="absolute top-0 right-0 p-3" data-bs-dismiss="alert" aria-label="Close">
                <span class="text-green-700">&times;</span>
            </button>
        </div>
    @endif
    <div class="flex flex-wrap -mx-2">
        <div class="w-full md:w-1/4 px-2">
            <div class="bg-white shadow-md rounded-lg w-[18rem]">
                <img src="{{ asset('storage/' . (auth()->user()->avatar ?? 'img.png')) }}" class="w-full h-[280px] object-cover rounded-t-lg" alt="User image">
                <div class="p-4">
                    <h5 class="text-center text-lg font-semibold">{{ auth()->user()->name }}</h5>
                    <p class="text-center text-gray-500">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
        <div class="w-full md:w-3/4 px-2 border border-gray-300">
            <ul class="flex border-b border-gray-200" id="myTab" role="tablist">
                <li class="flex-1" role="presentation">
                    <a class="block py-2 px-4 text-center {{ $tabOpen == 1 ? 'bg-gray-100 border-b-2 border-indigo-500' : 'text-gray-600 hover:bg-gray-100' }}" wire:click="tabOpn(1)" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                </li>
                <li class="flex-1" role="presentation">
                    <a class="block py-2 px-4 text-center {{ $tabOpen == 2 ? 'bg-gray-100 border-b-2 border-indigo-500' : 'text-gray-600 hover:bg-gray-100' }}" wire:click="tabOpn(2)" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Change Password</a>
                </li>
                <li class="flex-1" role="presentation">
                    <a class="block py-2 px-4 text-center {{ $tabOpen == 3 ? 'bg-gray-100 border-b-2 border-indigo-500' : 'text-gray-600 hover:bg-gray-100' }}" wire:click="tabOpn(3)" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Addresses</a>
                </li>
            </ul>
            <div class="my-3" id="myTabContent">
                <div class="{{ $tabOpen == 1 ? 'block' : 'hidden' }}" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h5 class="text-lg font-semibold">Profile :</h5>
                    <form wire:submit.prevent="updateName">
                        <div class="flex flex-wrap -mx-2">
                            <div class="w-full md:w-1/2 px-2 mb-3">
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="name">
                                @error('name')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2 px-2 mb-3">
                                <label class="block text-sm font-medium text-gray-700">Avatar</label>
                                <input type="file" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="avatar">
                            </div>
                            <button type="submit" class="bg-[#5C3422] text-white px-4 py-2 rounded mt-3 mx-auto hover:bg-[#4a2b1b]">Update</button>
                        </div>
                    </form>
                </div>
                <div class="{{ $tabOpen == 2 ? 'block' : 'hidden' }}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <h5 class="text-lg font-semibold">Change Password :</h5>
                    <form wire:submit.prevent="changePassword">
                        <div class="flex flex-wrap -mx-2">
                            <div class="w-full px-2 mb-3">
                                <label class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="oldPass">
                                @error('oldPass')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="w-full px-2 mb-3">
                                <label class="block text-sm font-medium text-gray-700">New Password</label>
                                <input type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="newPass">
                                @error('newPass')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="w-full px-2 mb-3">
                                <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                <input type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="newPass_confirmation">
                                @error('newPass_confirmation')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="bg-[#5C3422] text-white px-4 py-2 rounded mt-3 mx-auto hover:bg-[#4a2b1b]">Change Password</button>
                        </div>
                    </form>
                </div>
                <div class="{{ $tabOpen == 3 ? 'block' : 'hidden' }}" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <h5 class="text-lg font-semibold">Addresses :</h5>
                    <div class="flex flex-wrap justify-evenly mx-2">
                        @foreach(auth()->user()->userAddresses as $k => $add)
                            <div class="mb-3 border border-gray-300 p-2 rounded mx-auto">
                                <label for="address_{{ $add->id }}" class="flex text-sm font-medium text-gray-700"> {!! $add->address !!}, {{ $add->city }}, {{ $add->state }}, {{ $add->pin }} , <b class="ml-1">Mo:</b> {{ $add->phone }}</label>
                            </div>
                        @endforeach
                    </div>
                    <h5 class="text-lg font-semibold">Add New Address</h5>
                    <form wire:submit.prevent="addAddress">
                        <div class="flex flex-wrap -mx-2">
                            <div class="w-full px-2 mb-3">
                                <label class="block text-sm font-medium text-gray-700">Address</label>
                                <textarea type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="address"></textarea>
                                @error('address')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2 px-2 mb-3">
                                <label class="block text-sm font-medium text-gray-700">Pincode</label>
                                <input type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="pin">
                                @error('pin')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2 px-2 mb-3">
                                <label class="block text-sm font-medium text-gray-700">City</label>
                                <input type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="city">
                                @error('city')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2 px-2 mb-3">
                                <label class="block text-sm font-medium text-gray-700">State</label>
                                <input type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="state">
                                @error('state')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2 px-2 mb-3">
                                <label class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="phone">
                                @error('phone')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="bg-[#5C3422] text-white px-4 py-2 rounded mt-3 mx-auto hover:bg-[#4a2b1b]">Add Address</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>