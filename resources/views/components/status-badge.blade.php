{{-- Composant badge de statut --}}
@props(['status', 'type' => 'request'])

@php
$labels = [
    'request' => [
        'pending'   => ['label' => 'En attente', 'class' => 'bg-amber-100 text-amber-800'],
        'accepted'  => ['label' => 'Acceptée',   'class' => 'bg-blue-100 text-blue-800'],
        'completed' => ['label' => 'Terminée',   'class' => 'bg-emerald-100 text-emerald-800'],
        'cancelled' => ['label' => 'Annulée',    'class' => 'bg-red-100 text-red-800'],
    ],
    'offer' => [
        'pending'   => ['label' => 'En attente', 'class' => 'bg-amber-100 text-amber-800'],
        'accepted'  => ['label' => 'Acceptée',   'class' => 'bg-emerald-100 text-emerald-800'],
        'rejected'  => ['label' => 'Rejetée',    'class' => 'bg-red-100 text-red-800'],
        'cancelled' => ['label' => 'Annulée',    'class' => 'bg-gray-100 text-gray-600'],
    ],
    'mission' => [
        'pending'     => ['label' => 'En attente',    'class' => 'bg-amber-100 text-amber-800'],
        'accepted'    => ['label' => 'Acceptée',      'class' => 'bg-blue-100 text-blue-800'],
        'in_delivery' => ['label' => 'En livraison',  'class' => 'bg-purple-100 text-purple-800'],
        'delivered'   => ['label' => 'Livrée',        'class' => 'bg-emerald-100 text-emerald-800'],
        'cancelled'   => ['label' => 'Annulée',       'class' => 'bg-red-100 text-red-800'],
    ],
];
$config = $labels[$type][$status] ?? ['label' => $status, 'class' => 'bg-gray-100 text-gray-600'];
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $config['class'] }}">
    {{ $config['label'] }}
</span>
