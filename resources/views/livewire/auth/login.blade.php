<div class="container mx-auto my-8 px-4 sm:px-6 lg:px-8 min-h-screen">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-lg rounded-lg">
                <h4 class="text-center text-white py-4 rounded-t-lg bg-pink-400">Sign In</h4>

                <div class="p-6">
                    <form wire:submit="login">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" wire:model="email"
                                class="mt-1 block w-full px-3 py-2 border border-pink-300 rounded-md @error('email') border-red-500 @enderror"
                                required autofocus>
                            @error('email')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" wire:model="password"
                                class="mt-1 block w-full px-3 py-2 border border-pink-300 rounded-md @error('password') border-red-500 @enderror"
                                required>
                            @error('password')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="remember" class="rounded">
                                <span class="ml-2 text-sm text-gray-600">Remember me</span>
                            </label>
                        </div>

                        <button type="submit"
                            class="w-full px-5 py-2 text-white rounded-md bg-pink-400 hover:bg-pink-700"
                            wire:loading.attr="disabled" wire:target="login">
                            <span wire:loading.remove wire:target="login">Sign In</span>
                            <span wire:loading wire:target="login">You are Signing In...</span>

                        </button>

                        @if (Route::has('password.request'))
                            <a wire:navigate href="{{ route('password.request') }}"
                                class="block text-center mt-3 text-sm text-blue-900 hover:underline">
                                Forgot Your Password?
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
