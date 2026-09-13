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

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'city',
        'address',
        'active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

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
