@extends('layout.app')

@section('content')
<div class="container mx-auto my-8">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-lg rounded-lg">
                <h4 class="text-center text-white py-4 rounded-t-lg" style="background-color: #5C3422">{{ __('Sign Up') }}</h4>

                <div class="p-6">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>

                            <div>
                                <input id="name" type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#5C3422] focus:border-[#5C3422] @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="text-red-600 text-sm mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email Address') }}</label>

                            <div>
                                <input id="email" type="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#5C3422] focus:border-[#5C3422] @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="text-red-600 text-sm mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>

                            <div>
                                <input id="password" type="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#5C3422] focus:border-[#5C3422] @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="text-red-600 text-sm mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="block text-sm font-medium text-gray-700">{{ __('Confirm Password') }}</label>

                            <div>
                                <input id="password-confirm" type="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#5C3422] focus:border-[#5C3422]" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mb-0">
                            <div class="flex justify-center">
                                <button type="submit" class="px-5 py-2 text-white rounded-md hover:bg-[#4a2b1c] focus:outline-none focus:ring-2 focus:ring-[#5C3422] focus:ring-offset-2" style="background-color: #5C3422">
                                    {{ __('Sign Up') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection