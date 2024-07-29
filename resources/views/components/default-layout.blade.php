@props([
  'title' => null
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }} | {{ config('app.name') }}</title>

        @vite('resources/js/app.js')
    </head>
    <body class="font-sans antialiased">
        <div class="p-6 bg-black">
            <a href="/" class="w-60 block">
                <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="Gambling.com Group">
            </a>
        </div>
        <div class="container mx-auto p-10 md:p-0 md:py-10">
            {{ $slot }}
        </div>
    </body>
</html>
