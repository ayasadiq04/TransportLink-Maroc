<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->user()->role !== 'transporteur') {
            return false;
        }

        $transportRequest = $this->route('transportRequest');

        if (!$transportRequest || $transportRequest->status !== 'pending') {
            return false;
        }

        return !\App\Models\Offer::where('transport_request_id', $transportRequest->id)
            ->where('transporteur_id', $this->user()->id)
            ->exists();
    }

    public function rules(): array
    {
        return [
            'vehicle_id' => [
                'required',
                'exists:vehicles,id',
            ],
            'amount' => [
                'required',
                'numeric',
                'min:1',
            ],
            'message' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'conditions' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'estimated_delivery_time' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $vehicle = \App\Models\Vehicle::where('id', $this->vehicle_id)
                ->where('transporteur_id', $this->user()->id)
                ->where('available', true)
                ->first();

            if (!$vehicle) {
                $validator->errors()->add('vehicle_id', 'Ce véhicule ne vous appartient pas ou n\'est pas disponible.');
            }
        });
    }
}
