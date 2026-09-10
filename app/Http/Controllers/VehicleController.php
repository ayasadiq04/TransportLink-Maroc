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
        $this->authorize('create', Vehicle::class);

        return view('transporteur.vehicles.create');
    }

    public function store(StoreVehicleRequest $request)
    {
        $validated = $request->validated();

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
        $validated = $request->validated();

        // available est une checkbox, si absent = false
        $validated['available'] = $request->has('available');

        $vehicle->update($validated);

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
