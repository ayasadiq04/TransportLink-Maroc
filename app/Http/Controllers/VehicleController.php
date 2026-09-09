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

        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        $this->authorize('create', Vehicle::class);

        return view('vehicles.create');
    }

    public function store(StoreVehicleRequest $request)
    {
        $validated = $request->validated();
        $validated['transporteur_id'] = auth()->id();

        Vehicle::create($validated);

        return redirect()
            ->route('transporteur.vehicles.index')
            ->with('success', 'Véhicule ajouté avec succès.');
    }

    public function edit(Vehicle $vehicle)
    {
        $this->authorize('update', $vehicle);

        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->validated());

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

        $vehicle->delete();

        return redirect()
            ->route('transporteur.vehicles.index')
            ->with('success', 'Véhicule supprimé avec succès.');
    }
}
