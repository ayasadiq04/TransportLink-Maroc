@props([
    'dark' => false,
    'size' => 'md',
    'withText' => true,
])

@php
    $imgSizes = [
        'xs' => 'h-6',
        'sm' => 'h-8',
        'md' => 'h-10',
        'lg' => 'h-14',
        'xl' => 'h-16',
    ];
    $titleSizes = [
        'xs' => 'text-sm',
        'sm' => 'text-base',
        'md' => 'text-lg',
        'lg' => 'text-xl',
        'xl' => 'text-2xl',
    ];
    $subSizes = [
        'xs' => 'text-[0.5rem]',
        'sm' => 'text-[0.58rem]',
        'md' => 'text-[0.62rem]',
        'lg' => 'text-[0.7rem]',
        'xl' => 'text-[0.78rem]',
    ];

    $imgClass = $imgSizes[$size] ?? $imgSizes['md'];
    $titleClass = $titleSizes[$size] ?? $titleSizes['md'];
    $subClass = $subSizes[$size] ?? $subSizes['md'];
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-3 shrink-0 select-none group']) }}>
    <img
        src="{{ $dark ? asset('images/logo-white.png') : asset('images/logo.png') }}"
        alt="TransportLink Maroc"
        class="{{ $imgClass }} w-auto object-contain shrink-0 transition-transform duration-200 group-hover:scale-105"
        loading="eager"
    >

    @if($withText)
        <div class="leading-none text-left">
            <span class="block {{ $titleClass }} font-black {{ $dark ? 'text-white' : 'text-gray-900' }} tracking-[-0.02em]">
                TransportLink
            </span>
            <small class="block {{ $subClass }} font-bold uppercase tracking-[0.1em] {{ $dark ? 'text-emerald-400' : 'text-emerald-500' }} -mt-px">
                Maroc
            </small>
        </div>
    @endif
</div>

