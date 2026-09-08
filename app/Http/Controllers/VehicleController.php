<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::where('transporteur_id', auth()->id())
            ->latest()
            ->get();

        return view('transporteur.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('transporteur.vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'                => 'required|string|max:255',
            'brand'               => 'nullable|string|max:255',
            'model'               => 'nullable|string|max:255',
            'registration_number' => 'required|string|max:255|unique:vehicles,registration_number',
            'capacity'            => 'required|numeric|min:0',
        ], [
            'type.required'                => 'Le type de véhicule est obligatoire.',
            'registration_number.required' => 'La plaque d\'immatriculation est obligatoire.',
            'registration_number.unique'   => 'Cette plaque d\'immatriculation est déjà enregistrée.',
            'capacity.required'            => 'La capacité est obligatoire.',
            'capacity.numeric'             => 'La capacité doit être un nombre.',
        ]);

        $validated['transporteur_id'] = auth()->id();
        $validated['available']       = true;

        Vehicle::create($validated);

        return redirect()
            ->route('transporteur.vehicles.index')
            ->with('success', 'Véhicule ajouté avec succès.');
    }

    public function edit(Vehicle $vehicle)
    {
        abort_unless($vehicle->transporteur_id === auth()->id(), 403);

        return view('transporteur.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        abort_unless($vehicle->transporteur_id === auth()->id(), 403);

        $validated = $request->validate([
            'type'                => 'required|string|max:255',
            'brand'               => 'nullable|string|max:255',
            'model'               => 'nullable|string|max:255',
            'registration_number' => 'required|string|max:255|unique:vehicles,registration_number,' . $vehicle->id,
            'capacity'            => 'required|numeric|min:0',
            'available'           => 'boolean',
        ], [
            'type.required'                => 'Le type de véhicule est obligatoire.',
            'registration_number.required' => 'La plaque d\'immatriculation est obligatoire.',
            'registration_number.unique'   => 'Cette plaque d\'immatriculation est déjà enregistrée.',
            'capacity.required'            => 'La capacité est obligatoire.',
        ]);

        // available est une checkbox, si absent = false
        $validated['available'] = $request->has('available');

        $vehicle->update($validated);

        return redirect()
            ->route('transporteur.vehicles.index')
            ->with('success', 'Véhicule modifié avec succès.');
    }

    public function destroy(Vehicle $vehicle)
    {
        abort_unless($vehicle->transporteur_id === auth()->id(), 403);

        // Verifier que le vehicule n'est pas en mission active
        if (!$vehicle->available) {
            return redirect()
                ->route('transporteur.vehicles.index')
                ->with('error', 'Ce véhicule est actuellement en mission et ne peut pas être supprimé.');
        }

        $vehicle->delete();

        return redirect()
            ->route('transporteur.vehicles.index')
            ->with('success', 'Véhicule supprimé avec succès.');
    }
}