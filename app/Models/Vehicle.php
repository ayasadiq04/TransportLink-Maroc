<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'transporteur_id',
        'type',
        'brand',
        'model',
        'registration_number',
        'capacity',
        'available',
    ];

    protected $casts = [
        'capacity' => 'decimal:2',
        'available' => 'boolean',
    ];

    public function transporteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'transporteur_id');
    }
    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function missions(): HasMany
    {
        return $this->hasMany(Mission::class, 'vehicle_id');
    }
}