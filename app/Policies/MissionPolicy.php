<?php

namespace App\Policies;

use App\Models\Mission;
use App\Models\User;

class MissionPolicy
{
    public function view(User $user, Mission $mission): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $mission->client_id === $user->id || $mission->transporteur_id === $user->id;
    }

    public function updateStatus(User $user, Mission $mission): bool
    {
        return $user->role === 'transporteur' && $mission->transporteur_id === $user->id;
    }

    public function review(User $user, Mission $mission): bool
    {
        return $user->role === 'client'
            && $mission->client_id === $user->id
            && $mission->status === 'delivered'
            && !$mission->review;
    }
}
