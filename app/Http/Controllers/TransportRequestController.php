<?php

namespace App\Http\Controllers;

use App\Models\TransportRequest;
use Illuminate\Http\Request;

class TransportRequestController extends Controller
{
    public function create()
    {
        return view('transport-requests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'departure_city' => 'required|string|max:255',
            'departure_address' => 'required|string|max:255',
            'destination_city' => 'required|string|max:255',
            'destination_address' => 'required|string|max:255',
            'pickup_at' => 'required|date',
            'goods_type' => 'required|in:palette,vrac,frigorifique,liquide,colis_volumineux,autre',
            'weight' => 'nullable|numeric|min:0',
            'volume' => 'nullable|numeric|min:0',
            'instructions' => 'nullable|string',
            'estimated_budget' => 'nullable|numeric|min:0',
        ]);

        $validated['client_id'] = auth()->id();

        TransportRequest::create($validated);

        return redirect()
            ->route('transport-requests.create')
            ->with('success', 'Demande créée avec succès.');
    }
}