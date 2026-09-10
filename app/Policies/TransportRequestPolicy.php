<?php

namespace App\Policies;

use App\Models\TransportRequest;
use App\Models\User;

class TransportRequestPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === 'client' || $user->role === 'admin';
    }

    public function view(User $user, TransportRequest $transportRequest): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'client' && $transportRequest->client_id === $user->id) {
            return true;
        }

        if ($user->role === 'transporteur') {
            // Une demande en attente est visible par tous les transporteurs
            if ($transportRequest->status === 'pending') {
                return true;
            }

            // Un transporteur peut consulter une demande non-pending s'il y a
            // déposé une offre ou s'il est assigné à la mission associée.
            if ($transportRequest->offers()->where('transporteur_id', $user->id)->exists()) {
                return true;
            }

            if ($transportRequest->mission()->where('transporteur_id', $user->id)->exists()) {
                return true;
            }
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->role === 'client';
    }

    public function update(User $user, TransportRequest $transportRequest): bool
    {
        return $user->role === 'client'
            && $transportRequest->client_id === $user->id
            && $transportRequest->status === 'pending';
    }

    public function delete(User $user, TransportRequest $transportRequest): bool
    {
        return $user->role === 'client'
            && $transportRequest->client_id === $user->id
            && $transportRequest->status === 'pending';
    }
}
