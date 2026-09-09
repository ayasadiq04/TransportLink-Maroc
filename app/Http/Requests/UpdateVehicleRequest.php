<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->id === $this->route('vehicle')->transporteur_id;
    }

    public function rules(): array
    {
        return [
            'type'                => 'required|string|max:255',
            'brand'               => 'nullable|string|max:255',
            'model'               => 'nullable|string|max:255',
            'registration_number' => 'required|string|max:255|unique:vehicles,registration_number,' . $this->route('vehicle')->id,
            'capacity'            => 'required|numeric|min:0.1',
        ];
    }
}
