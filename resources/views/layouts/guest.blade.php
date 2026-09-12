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
            <a href="/" class="flex items-center justify-center gap-2.5 mb-8">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-600 to-indigo-500 flex items-center justify-center shadow-[0_4px_14px_rgba(79,70,229,0.35)]">
                    <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                    </svg>
                </div>
                <span class="text-xl font-black text-gray-900 tracking-[-0.02em]">TransportLink <span class="text-indigo-600">Maroc</span></span>
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