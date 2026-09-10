@props([
    'type' => 'success',
    'wrapperClass' => 'max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8',
])

@php
$styles = [
    'success' => [
        'wrapper' => 'bg-emerald-50 border border-emerald-200 text-emerald-800',
        'icon'    => 'text-emerald-600',
        'close'   => 'text-emerald-600 hover:text-emerald-800',
        'svg'     => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
    ],
    'error' => [
        'wrapper' => 'bg-red-50 border border-red-200 text-red-800',
        'icon'    => 'text-red-600',
        'close'   => 'text-red-600 hover:text-red-800',
        'svg'     => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
    ],
    'warning' => [
        'wrapper' => 'bg-amber-50 border border-amber-200 text-amber-800',
        'icon'    => 'text-amber-600',
        'close'   => 'text-amber-600 hover:text-amber-800',
        'svg'     => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
    ],
][$type];
@endphp

<div class="{{ $wrapperClass }}">
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 5000)"
        x-show="show"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        x-on:keydown.escape.window="show = false"
        class="flex items-center gap-3 {{ $styles['wrapper'] }} px-4 py-3 rounded-xl shadow-sm"
        role="alert"
    >
        <svg class="w-5 h-5 flex-shrink-0 {{ $styles['icon'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $styles['svg'] }}"/>
        </svg>
        <span class="text-sm font-medium">{{ $slot }}</span>
        <button
            type="button"
            @click="show = false"
            class="ml-auto {{ $styles['close'] }}"
            aria-label="Fermer le message"
        >✕</button>
    </div>
</div>