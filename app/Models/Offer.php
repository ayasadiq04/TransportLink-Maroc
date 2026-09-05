<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    protected $fillable = [
        'transport_request_id',
        'transporteur_id',
        'vehicle_id',
        'price',
        'message',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
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
        return $this->belongsTo(
            Vehicle::class,
            'vehicle_id'
        );
    }
}