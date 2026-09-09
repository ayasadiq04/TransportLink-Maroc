<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'transport_request_id',
        'transporteur_id',
        'vehicle_id',
        'amount',
        'message',
        'conditions',
        'estimated_delivery_time',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function transportRequest(): BelongsTo
    {
        return $this->belongsTo(
            TransportRequest::class,
            'transport_request_id'
        );
    }

    public function transporteur(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'transporteur_id'
        );
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function mission(): HasOne
    {
        return $this->hasOne(Mission::class, 'offer_id');
    }
}