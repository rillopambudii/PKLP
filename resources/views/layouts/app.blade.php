<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/design-tokens.css') }}" rel="stylesheet">
        {{-- Alpine.js via CDN (komponen dropdown/modal/navigation) — tanpa npm/build --}}
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        {{-- anti-flash: terapkan tema sebelum paint --}}
        <script>try{if(localStorage.getItem('pklp-theme')==='dark')document.documentElement.setAttribute('data-theme','dark');}catch(e){}</script>
        <style>
            .min-h-screen.bg-gray-100 { background: var(--color-bg) !important; }
            header.bg-white { background: var(--color-surface) !important; color: var(--color-text); border-bottom: 1px solid var(--color-border); }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script src="{{ asset('js/theme-toggle.js') }}"></script>
    </body>
</html>
