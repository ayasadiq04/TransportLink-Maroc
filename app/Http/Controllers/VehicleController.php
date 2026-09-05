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

        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'registration_number' => 'required|string|max:255|unique:vehicles,registration_number',
            'capacity' => 'required|numeric|min:0',
        ]);

        $validated['transporteur_id'] = auth()->id();

        Vehicle::create($validated);

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Véhicule ajouté avec succès.');
    }

    public function edit(Vehicle $vehicle)
    {
        abort_unless($vehicle->transporteur_id === auth()->id(), 403);

        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        abort_unless($vehicle->transporteur_id === auth()->id(), 403);

        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'registration_number' => 'required|string|max:255|unique:vehicles,registration_number,' . $vehicle->id,
            'capacity' => 'required|numeric|min:0',
        ]);

        $vehicle->update($validated);

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Véhicule modifié avec succès.');
    }

    public function destroy(Vehicle $vehicle)
    {
        abort_unless($vehicle->transporteur_id === auth()->id(), 403);

        $vehicle->delete();

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Véhicule supprimé avec succès.');
    }
}