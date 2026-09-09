<?php

namespace App\Policies;

use App\Models\Offer;
use App\Models\User;

class OfferPolicy
{
    public function view(User $user, Offer $offer): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'transporteur' && $offer->transporteur_id === $user->id) {
            return true;
        }

        if ($user->role === 'client' && $offer->transportRequest->client_id === $user->id) {
            return true;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->role === 'transporteur';
    }

    public function accept(User $user, Offer $offer): bool
    {
        return $user->role === 'client'
            && $offer->transportRequest->client_id === $user->id
            && $offer->status === 'pending'
            && $offer->transportRequest->status === 'pending';
    }

    public function reject(User $user, Offer $offer): bool
    {
        return $user->role === 'client'
            && $offer->transportRequest->client_id === $user->id
            && $offer->status === 'pending';
    }
}
