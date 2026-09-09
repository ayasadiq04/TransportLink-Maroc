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

        if ($user->role === 'transporteur' && $transportRequest->status === 'pending') {
            return true;
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
