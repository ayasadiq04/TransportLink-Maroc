<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TransportLink') }} - Connexion</title>

    <!-- Favicons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-['Inter',sans-serif] antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">

            {{-- Logo --}}
            <a href="/" class="flex items-center justify-center mb-8">
                <x-application-logo size="lg" />
            </a>

            {{-- Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-6 sm:px-8 py-8 sm:py-10">
                @if(session('success'))
                    <div class="mb-5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-4 py-3">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="mb-5 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3">{{ session('error') }}</div>
                @endif

                {{ $slot }}
            </div>

            {{-- Back to home --}}
            <a href="{{ url('/') }}" class="flex items-center justify-center gap-1.5 mt-6 text-xs font-medium text-gray-400 hover:text-indigo-600 transition-colors duration-200">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Retour à l'accueil
            </a>
        </div>
    </div>
</body>
</html>