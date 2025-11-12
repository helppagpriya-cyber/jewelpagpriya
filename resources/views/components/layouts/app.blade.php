<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @push('scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="{{ asset('js/razorpay.js') }}"></script>
    @endpush
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            @vite(['resources/css/app.css', 'resources/js/app.js'])
            @livewireStyles            

        <title>{{ $title ?? 'PAGPRIYA by Ojas Jewel' }}</title>
    </head>

    <body>
    
        {{ $slot }}
        @livewireScripts
    </body>
</html>
