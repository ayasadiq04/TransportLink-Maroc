<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Vehicle::class);

        $vehicles = Vehicle::where('transporteur_id', auth()->id())
            ->latest()
            ->get();

        return view('transporteur.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
<<<<<<< HEAD
        $this->authorize('create', Vehicle::class);

        return view('vehicles.create');
=======
        return view('transporteur.vehicles.create');
>>>>>>> 230d605c40ca0950958722dca40f541066fdc464
    }

    public function store(StoreVehicleRequest $request)
    {
<<<<<<< HEAD
        $validated = $request->validated();
=======
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

>>>>>>> 230d605c40ca0950958722dca40f541066fdc464
        $validated['transporteur_id'] = auth()->id();
        $validated['available']       = true;

        Vehicle::create($validated);

        return redirect()
            ->route('transporteur.vehicles.index')
            ->with('success', 'Véhicule ajouté avec succès.');
    }

    public function edit(Vehicle $vehicle)
    {
        $this->authorize('update', $vehicle);

        return view('transporteur.vehicles.edit', compact('vehicle'));
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
<<<<<<< HEAD
        $vehicle->update($request->validated());
=======
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
>>>>>>> 230d605c40ca0950958722dca40f541066fdc464

        return redirect()
            ->route('transporteur.vehicles.index')
            ->with('success', 'Véhicule modifié avec succès.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $this->authorize('delete', $vehicle);

        if ($vehicle->missions()->whereIn('status', ['pending', 'accepted', 'in_delivery'])->exists()) {
            return back()->with('error', 'Impossible de supprimer un véhicule utilisé dans une mission active.');
        }

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
