<!-- Notifications -->
<div class="relative" x-data="{ open: false }">
    @php
        $unreadCount = auth()->user()->unreadNotifications()->count();
        $recentNotifications = auth()->user()->notifications()->latest()->take(5)->get();
    @endphp

    <button @click="open = !open"
            class="relative p-2 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition-colors"
            aria-label="Notifications">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        @if($unreadCount > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center min-w-[18px] h-[18px] px-1 text-[10px] font-bold text-white bg-red-500 rounded-full border-2 border-white">
                {{ $unreadCount > 99 ? '99+' : $unreadCount }}
            </span>
        @endif
    </button>

    <div x-show="open"
         @click.outside="open = false"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute right-0 mt-2 w-80 sm:w-96 max-h-[65vh] overflow-y-auto bg-white rounded-xl shadow-lg border border-gray-200 z-50"
         style="display: none;">
        <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between sticky top-0 bg-white">
            <p class="text-sm font-semibold text-gray-900">Notifications</p>
            @if($unreadCount > 0)
                <form method="POST" action="{{ route('notifications.read-all') }}">
                    @csrf
                    <button type="submit" class="text-xs font-medium text-blue-600 hover:text-blue-700">
                        Tout marquer comme lu
                    </button>
                </form>
            @endif
        </div>

        <div class="divide-y divide-gray-50">
            @forelse($recentNotifications as $notification)
                @php $data = $notification->data; @endphp
                <a href="{{ $data['url'] ?? route('notifications.index') }}"
                   data-notification-id="{{ $notification->id }}"
                   class="block px-4 py-3 hover:bg-gray-50 transition-colors {{ $notification->read_at ? '' : 'bg-blue-50/60' }}">
                    <p class="text-sm font-medium text-gray-900 {{ $notification->read_at ? '' : 'font-semibold' }}">{{ $data['title'] ?? 'Notification' }}</p>
                    <p class="text-xs text-gray-600 mt-0.5 line-clamp-2">{{ $data['message'] ?? '' }}</p>
                    <p class="text-[10px] text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                </a>
            @empty
                <p class="px-4 py-8 text-center text-sm text-gray-500">Aucune notification.</p>
            @endforelse
        </div>

        <div class="px-4 py-2 border-t border-gray-100 sticky bottom-0 bg-white">
            <a href="{{ route('notifications.index') }}"
               class="block text-center text-xs font-semibold text-blue-600 hover:text-blue-700 py-1">
                Voir toutes les notifications
            </a>
        </div>
    </div>
</div>