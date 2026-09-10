<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'transport_request_id',
        'offer_id',
        'client_id',
        'transporteur_id',
        'vehicle_id',
        'status',
        'planned_at',
        'delivered_at',
    ];

    protected $casts = [
        'planned_at'   => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function transportRequest(): BelongsTo
    {
        return $this->belongsTo(TransportRequest::class, 'transport_request_id');
    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function transporteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'transporteur_id');
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
