@extends('layout.app')
@section('content')
    <div class="container mx-auto my-8 px-4 sm:px-6 lg:px-8 min-h-screen">
        <div class="flex justify-center">
            <div class="w-full max-w-md">
                <div class="bg-white shadow-lg rounded-lg">
                    <h4 class="text-center text-white py-4 rounded-t-lg bg-pink-400">{{ __('Sign In') }}</h4>

                    <div class="p-6">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="email"
                                    class="block text-sm font-medium text-gray-700">{{ __('Email Address') }}</label>

                                <div>
                                    <input id="email" type="email"
                                        class="mt-1 block w-full px-3 py-2 border border-pink-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-600 @error('email') border-red-500 @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="text-red-600 text-sm mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password"
                                    class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>

                                <div>
                                    <input id="password" type="password"
                                        class="mt-1 block w-full px-3 py-2 border border-pink-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-500 @error('password') border-red-500 @enderror"
                                        name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="text-red-600 text-sm mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-0">
                                <div class="flex flex-col items-center">
                                    <button type="submit"
                                        class="w-full px-5 py-2 text-white rounded-md hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-800 focus:ring-offset-2 bg-pink-400">
                                        {{ __('Sign In') }}

                                    </button>


                                    @if (Route::has('password.request'))
                                        <a class="mt-2 text-sm text-blue-900 hover:underline w-full text-right"
                                            href="{{ route('password.request') }}">
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
