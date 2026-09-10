<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchAvailableTransportRequestsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === 'transporteur';
    }

    public function rules(): array
    {
        return [
            'departure'       => 'nullable|string|max:255',
            'departure_city'  => 'nullable|string|max:255',
            'arrival'         => 'nullable|string|max:255',
            'destination_city'=> 'nullable|string|max:255',
            'cargo'           => 'nullable|string|max:255',
            'goods_type'      => 'nullable|in:palette,vrac,frigorifique,liquide,colis_volumineux,autre',
            'weight_min'      => 'nullable|numeric|min:0',
            'weight_max'      => 'nullable|numeric|min:0',
            'pickup_date'     => 'nullable|date|after_or_equal:today',
            'status'          => 'nullable|in:pending',
        ];
    }

    public function filters(): array
    {
        $validated = $this->validated();

        return [
            'departure'  => trim($validated['departure'] ?? ($validated['departure_city'] ?? '')),
            'arrival'    => trim($validated['arrival'] ?? ($validated['destination_city'] ?? '')),
            'cargo'      => trim($validated['cargo'] ?? ($validated['goods_type'] ?? '')),
            'goods_type' => $validated['goods_type'] ?? null,
            'weight_min' => $validated['weight_min'] ?? null,
            'weight_max' => $validated['weight_max'] ?? null,
            'pickup_date'=> $validated['pickup_date'] ?? null,
            'status'     => $validated['status'] ?? 'pending',
        ];
    }
}