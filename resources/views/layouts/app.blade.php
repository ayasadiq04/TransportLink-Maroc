<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="TransportLink Maroc — Plateforme de mise en relation transport et logistique au Maroc">

        <title>{{ $title ?? config('app.name', 'TransportLink Maroc') }}</title>

        <!-- Favicons -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        <link rel="alternate icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Inter', sans-serif; }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900">

        <div class="min-h-screen flex flex-col">

            <!-- Navigation -->
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white border-b border-gray-200">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Alerts globales -->
            @if(session('success'))
                <x-flash type="success">{{ session('success') }}</x-flash>
            @endif

            @if(session('error'))
                <x-flash type="error">{{ session('error') }}</x-flash>
            @endif

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 mt-auto">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <x-application-logo size="sm" />
                        <p class="text-sm text-gray-500">© {{ date('Y') }} TransportLink Maroc. Tous droits réservés.</p>
                    </div>
                </div>
            </footer>
        </div>

    </body>
</html>
