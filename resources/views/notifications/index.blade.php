<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mes notifications
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- En-tête -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-sm text-gray-500">
                        @if($unreadCount > 0)
                            Vous avez <span class="font-semibold text-gray-900">{{ $unreadCount }}</span> notification{{ $unreadCount > 1 ? 's' : '' }} non lue{{ $unreadCount > 1 ? 's' : '' }}.
                        @else
                            Vous avez toutes vos notifications à jour.
                        @endif
                    </p>
                </div>
                @if($unreadCount > 0)
                    <form method="POST" action="{{ route('notifications.read-all') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-xs font-semibold rounded-xl hover:bg-blue-700 transition-colors shadow-sm">
                            Tout marquer comme lu
                        </button>
                    </form>
                @endif
            </div>

            <!-- Liste -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden divide-y divide-gray-100">
                @forelse($notifications as $notification)
                    @php
                        $data    = $notification->data;
                        $isUnread = $notification->read_at === null;
                        $icon = match ($data['type'] ?? null) {
                            'new_request'    => ['📦', 'bg-indigo-100'],
                            'new_offer'      => ['🤝', 'bg-emerald-100'],
                            'offer_accepted' => ['✅', 'bg-emerald-100'],
                            'offer_rejected' => ['❌', 'bg-rose-100'],
                            'mission_status' => ['🚚', 'bg-amber-100'],
                            default          => ['🔔', 'bg-gray-100'],
                        };
                    @endphp
                    <a href="{{ $data['url'] ?? route('notifications.index') }}"
                       data-notification-id="{{ $notification->id }}"
                       class="flex items-start gap-4 px-5 py-4 hover:bg-gray-50 transition-colors {{ $isUnread ? 'bg-blue-50/50' : '' }}">
                        <div class="w-10 h-10 shrink-0 rounded-xl {{ $icon[1] }} flex items-center justify-center text-lg">
                            {{ $icon[0] }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="text-sm {{ $isUnread ? 'font-semibold text-gray-900' : 'font-medium text-gray-700' }}">
                                    {{ $data['title'] ?? 'Notification' }}
                                </p>
                                @if($isUnread)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 text-[10px] font-bold uppercase tracking-wide">
                                        Non lue
                                    </span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600 mt-0.5">{{ $data['message'] ?? '' }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                        @if($isUnread)
                            <form method="POST" action="{{ route('notifications.read', $notification) }}" class="shrink-0">
                                @csrf
                                <button type="submit" class="text-xs font-medium text-blue-600 hover:text-blue-700">
                                    Marquer comme lu
                                </button>
                            </form>
                        @endif
                    </a>
                @empty
                    <div class="px-6 py-16 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-gray-100 flex items-center justify-center text-2xl mb-4">🔔</div>
                        <p class="text-gray-500 font-medium">Aucune notification</p>
                        <p class="text-sm text-gray-400 mt-1">Les notifications concernant vos demandes, offres et missions apparaîtront ici.</p>
                    </div>
                @endforelse
            </div>

            @if($notifications->hasPages())
                <div class="mt-6">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>