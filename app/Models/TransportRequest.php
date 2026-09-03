<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransportRequest extends Model
{
    protected $fillable = [
        'client_id',
        'title',
        'departure_city',
        'departure_address',
        'destination_city',
        'destination_address',
        'pickup_at',
        'goods_type',
        'weight',
        'volume',
        'instructions',
        'estimated_budget',
        'status',
    ];

    protected $casts = [
        'pickup_at' => 'datetime',
        'weight' => 'decimal:2',
        'volume' => 'decimal:2',
        'estimated_budget' => 'decimal:2',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}