<div class="container mx-auto my-8 px-4 min-h-screen">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-lg rounded-lg">
                <h4 class="text-center text-white py-4 rounded-t-lg bg-pink-400">Forgot Password</h4>

                <div class="p-6">
                    <p class="text-sm text-gray-600 mb-6 text-center">
                        Enter your email and we'll send you a link to reset your password.
                    </p>

                    <form wire:submit="sendResetLink">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" wire:model="email"
                                class="mt-1 block w-full px-3 py-2 border border-pink-300 rounded-md @error('email') border-red-500 @enderror"
                                required>
                            @error('email')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="w-full py-3 text-white bg-pink-400 rounded-md hover:bg-pink-600">
                            Send Reset Link
                        </button>
                    </form>

                    <p class="text-center mt-4">
                        <a wire:navigate href="{{ route('login') }}" class="text-blue-900 hover:underline text-sm">Back
                            to Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
