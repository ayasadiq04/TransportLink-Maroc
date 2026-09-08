<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Modération des Avis & Évaluations</h1>
                <p class="text-sm text-gray-500 mt-1">Supervisez les retours laissés par les clients sur les transporteurs</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">
                &larr; Retour au dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Client (Auteur)</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Transporteur Évalué</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Note</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Commentaire</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach($reviews as $review)
                                <tr class="hover:bg-gray-50/80 transition">
                                    <td class="px-6 py-4 text-xs font-medium text-gray-900">
                                        {{ $review->client->name }}
                                    </td>
                                    <td class="px-6 py-4 text-xs font-medium text-gray-900">
                                        {{ $review->transporteur->name }}
                                    </td>
                                    <td class="px-6 py-4 text-xs whitespace-nowrap">
                                        <div class="flex items-center text-amber-500 font-bold">
                                            <span>★ {{ $review->rating }}/5</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-600 max-w-md">
                                        {{ $review->comment ?? 'Aucun commentaire' }}
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-500 whitespace-nowrap">
                                        {{ $review->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right text-xs whitespace-nowrap">
                                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Supprimer définitivement cet avis ?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-600 hover:text-rose-900 font-semibold">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if(method_exists($reviews, 'links'))
                <div class="mt-6">
                    {{ $reviews->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
