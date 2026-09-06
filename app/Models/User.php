<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'transporteur_id');
    }

    public function transportRequests(): HasMany
    {
        return $this->hasMany(TransportRequest::class, 'client_id');
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'transporteur_id');
    }

    public function missionsAsClient(): HasMany
    {
        return $this->hasMany(Mission::class, 'client_id');
    }

    public function missionsAsTransporteur(): HasMany
    {
        return $this->hasMany(Mission::class, 'transporteur_id');
    }

    public function reviewsGiven(): HasMany
    {
        return $this->hasMany(Review::class, 'client_id');
    }

    public function reviewsReceived(): HasMany
    {
        return $this->hasMany(Review::class, 'transporteur_id');
    }

    /**
     * Retourne la note moyenne du transporteur (1-5).
     */
    public function averageRating(): float
    {
        $avg = $this->reviewsReceived()->avg('rating');
        return round($avg ?? 0, 1);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }
}
