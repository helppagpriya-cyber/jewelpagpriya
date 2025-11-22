@extends('layouts.app')

@section('content')
<div class="container mx-auto my-8">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-lg rounded-lg">
                <h4 class="text-center text-white py-4 rounded-t-lg" style="background-color: #5C3422">{{ __('Confirm Password') }}</h4>
                <div class="p-6">
                    <p>{{ __('Please confirm your password before continuing.') }}</p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>

                            <div>
                                <input id="password" type="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#5C3422] focus:border-[#5C3422] @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="text-red-600 text-sm mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-0">
                            <div class="flex flex-col items-center">
                                <button type="submit" class="w-full px-5 py-2 text-white rounded-md hover:bg-[#4a2b1c] focus:outline-none focus:ring-2 focus:ring-[#5C3422] focus:ring-offset-2" style="background-color: #5C3422">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="mt-2 text-sm text-gray-900 hover:underline w-full text-center" wire:navigate href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection