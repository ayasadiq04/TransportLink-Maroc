<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransportRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->id === $this->route('transportRequest')->client_id
            && $this->route('transportRequest')->status === 'pending';
    }

    public function rules(): array
    {
        return [
            'title'               => 'required|string|max:255',
            'departure_city'      => 'required|string|max:255',
            'departure_address'   => 'required|string|max:255',
            'destination_city'    => 'required|string|max:255',
            'destination_address' => 'required|string|max:255',
            'pickup_at'           => 'required|date',
            'goods_type'          => 'required|in:palette,vrac,frigorifique,liquide,colis_volumineux,autre',
            'weight'              => 'nullable|numeric|min:0',
            'volume'              => 'nullable|numeric|min:0',
            'instructions'        => 'nullable|string|max:2000',
            'estimated_budget'    => 'nullable|numeric|min:0',
        ];
    }
}
