<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === 'transporteur';
    }

    public function rules(): array
    {
        return [
            'type'                => 'required|string|max:255',
            'brand'               => 'nullable|string|max:255',
            'model'               => 'nullable|string|max:255',
            'registration_number' => 'required|string|max:255|unique:vehicles,registration_number',
            'capacity'            => 'required|numeric|min:0.1',
        ];
    }
}
