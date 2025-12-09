<div class="container mx-auto my-8 px-4 min-h-screen">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-lg rounded-lg">
                <h4 class="text-center text-white py-4 rounded-t-lg bg-pink-400">Reset Password</h4>

                <div class="p-6">
                    <form wire:submit="resetPassword">
                        <div class="mb-4">
                            <label>Email</label>
                            <input type="email" wire:model="email"
                                class="mt-1 block w-full px-3 py-2 border border-pink-300 rounded-md @error('email') border-red-500 @enderror"
                                required>
                            @error('email')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label>New Password</label>
                            <input type="password" wire:model="password"
                                class="mt-1 block w-full px-3 py-2 border border-pink-300 rounded-md @error('password') border-red-500 @enderror"
                                required>
                            @error('password')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label>Confirm Password</label>
                            <input type="password" wire:model="password_confirmation"
                                class="mt-1 block w-full px-3 py-2 border border-pink-300 rounded-md" required>
                        </div>

                        <button type="submit" class="w-full py-3 text-white bg-pink-400 rounded-md hover:bg-pink-600">
                            Reset Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
