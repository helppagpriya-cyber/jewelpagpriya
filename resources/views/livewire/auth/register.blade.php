<div class="container mx-auto my-8 px-4 sm:px-6 lg:px-8 min-h-screen">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-lg rounded-lg">
                <h4 class="text-center text-white py-4 rounded-t-lg bg-pink-400">Create Account</h4>

                <div class="p-6">
                    <form wire:submit="register">
                        <!-- Name -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" wire:model="name"
                                class="mt-1 block w-full px-3 py-2 border border-pink-300 rounded-md shadow-sm focus:outline-none focus:ring-pink-400 focus:border-pink-500 @error('name') border-red-500 @enderror"
                                required autofocus>
                            @error('name')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" wire:model="email"
                                class="mt-1 block w-full px-3 py-2 border border-pink-300 rounded-md shadow-sm focus:outline-none focus:ring-pink-400 focus:border-pink-500 @error('email') border-red-500 @enderror"
                                required>
                            @error('email')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" wire:model="password"
                                class="mt-1 block w-full px-3 py-2 border border-pink-300 rounded-md shadow-sm focus:outline-none focus:ring-pink-400 focus:border-pink-500 @error('password') border-red-500 @enderror"
                                required>
                            @error('password')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" wire:model="password_confirmation"
                                class="mt-1 block w-full px-3 py-2 border border-pink-300 rounded-md shadow-sm focus:outline-none focus:ring-pink-400 focus:border-pink-500"
                                required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full px-5 py-3 text-white rounded-md bg-pink-400 hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-pink-800">
                            Register
                        </button>

                        <!-- Login Link -->
                        <p class="text-center mt-4 text-sm text-gray-600">
                            Already have an account?
                            <a wire:navigate href="{{ route('login') }}"
                                class="text-blue-900 hover:underline font-medium">
                                Sign In
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
