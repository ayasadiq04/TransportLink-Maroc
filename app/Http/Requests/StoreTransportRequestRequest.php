<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransportRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === 'client';
    }

    public function rules(): array
    {
        return [
            'title'               => 'required|string|max:255',
            'departure_city'      => 'required|string|max:255',
            'departure_address'   => 'required|string|max:255',
            'destination_city'    => 'required|string|max:255',
            'destination_address' => 'required|string|max:255',
            'pickup_at'           => 'required|date|after:now',
            'goods_type'          => 'required|in:palette,vrac,frigorifique,liquide,colis_volumineux,autre',
            'weight'              => 'nullable|numeric|min:0',
            'volume'              => 'nullable|numeric|min:0',
            'instructions'        => 'nullable|string|max:2000',
            'estimated_budget'    => 'nullable|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'pickup_at.after' => 'La date de collecte doit être dans le futur.',
            'goods_type.in'   => 'Ce type de marchandise n\'est pas pris en charge.',
        ];
    }
}
