@props([
    'dark' => false,
    'size' => 'md',
])

@php
    $iconSizes = [
        'xs' => 'w-7 h-7 rounded-lg',
        'sm' => 'w-9 h-9 rounded-xl',
        'md' => 'w-10 h-10 rounded-xl',
        'lg' => 'w-12 h-12 rounded-2xl',
    ];
    $svgSizes = [
        'xs' => 'w-[14px] h-[14px]',
        'sm' => 'w-[18px] h-[18px]',
        'md' => 'w-[22px] h-[22px]',
        'lg' => 'w-6 h-6',
    ];
    $titleSizes = [
        'xs' => 'text-sm',
        'sm' => 'text-base',
        'md' => 'text-lg',
        'lg' => 'text-xl',
    ];
    $subSizes = [
        'xs' => 'text-[0.5rem]',
        'sm' => 'text-[0.58rem]',
        'md' => 'text-[0.62rem]',
        'lg' => 'text-[0.7rem]',
    ];

    $iconClass = $iconSizes[$size] ?? $iconSizes['md'];
    $svgClass = $svgSizes[$size] ?? $svgSizes['md'];
    $titleClass = $titleSizes[$size] ?? $titleSizes['md'];
    $subClass = $subSizes[$size] ?? $subSizes['md'];
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5 shrink-0 select-none']) }}>
    <div class="{{ $iconClass }} bg-gradient-to-br from-indigo-600 to-indigo-500 flex items-center justify-center shadow-[0_4px_14px_rgba(79,70,229,0.35)] shrink-0">
        <svg
            class="{{ $svgClass }} text-white stroke-white fill-none"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <path d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
        </svg>
    </div>

    <div class="leading-none text-left">
        <span class="block {{ $titleClass }} font-black {{ $dark ? 'text-white' : 'text-gray-900' }} tracking-[-0.02em]">
            TransportLink
        </span>
        <small class="block {{ $subClass }} font-bold uppercase tracking-[0.1em] {{ $dark ? 'text-emerald-400' : 'text-emerald-500' }} -mt-px">
            Maroc
        </small>
    </div>
</div>
