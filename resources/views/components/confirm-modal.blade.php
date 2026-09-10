@props([
    'name',
    'title',
    'message',
    'action',
    'method' => 'DELETE',
    'confirmText' => 'Confirmer',
    'cancelText' => 'Annuler',
    'maxWidth' => 'md',
    'tone' => 'danger',
])

<x-modal :name="$name" :max-width="$maxWidth" focusable>
    <form method="POST" action="{{ $action }}" class="p-6">
        @csrf
        @if($method !== 'POST')
            @method($method)
        @endif

        <div class="sm:flex sm:items-start">
            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full sm:mx-0 {{ $tone === 'danger' ? 'bg-red-100' : 'bg-amber-100' }}">
                <svg class="h-6 w-6 {{ $tone === 'danger' ? 'text-red-600' : 'text-amber-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>

            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                <h3 class="text-base font-semibold text-gray-900">{{ $title }}</h3>
                <div class="mt-2 text-sm text-gray-600">
                    <p>{{ $message }}</p>
                </div>
            </div>
        </div>

        <div class="mt-6 flex flex-col-reverse sm:flex-row sm:justify-end sm:gap-3">
            <x-secondary-button
                type="button"
                x-on:click="$dispatch('close-modal', '{{ $name }}')"
                class="mt-3 sm:mt-0"
            >
                {{ $cancelText }}
            </x-secondary-button>

            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 {{ $tone === 'danger' ? 'bg-red-600 hover:bg-red-500' : 'bg-amber-600 hover:bg-amber-500' }} border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $tone === 'danger' ? 'focus:ring-red-500' : 'focus:ring-amber-500' }} transition ease-in-out duration-150"
            >
                {{ $confirmText }}
            </button>
        </div>
    </form>
</x-modal>