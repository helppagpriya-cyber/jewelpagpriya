
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Ojas Jewel' }}</title>
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    @include('../inc.navbar')

    <body>
        
        @yield('content')
        {{-- {{ $slot }} --}}
        @include('../inc.footer')
        
        @livewireScripts
    </body>
</html>

   


