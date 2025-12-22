<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>{{ $title ?? 'PAGPRIYA' }}</title>

    @livewireStyles
    @filamentStyles

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    @livewire('notifications')
    <div wire:ignore>
        <div x-data>
            @livewire('navbar')
        </div>
    </div>

    @yield('content')



    @livewire('wishlist-canvas')
    @livewire('cart-canvas')
    @livewire('orders-canvas')

    <div wire:ignore>
        <div x-data>
            @livewire('footer')
        </div>
    </div>

    @livewireScripts
    @filamentScripts

    <script>
        document.addEventListener('livewire:navigated', () => {

        });
    </script>
</body>

</html>
