<?php

namespace App\Http\Controllers;

use App\Models\TransportRequest;
use Illuminate\Http\Request;

class TransportRequestController extends Controller
{
    public function index()
    {
    $requests = TransportRequest::where('client_id', auth()->id())
        ->latest()
        ->get();

    return view('transport-requests.index', compact('requests'));
    }
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
    public function edit(TransportRequest $transportRequest)
    {
    abort_unless($transportRequest->client_id === auth()->id(), 403);

    return view('transport-requests.edit', compact('transportRequest'));
    }

    public function update(Request $request, TransportRequest $transportRequest)
    {
    abort_unless($transportRequest->client_id === auth()->id(), 403);

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

    $transportRequest->update($validated);

    return redirect()
        ->route('transport-requests.index')
        ->with('success', 'Demande modifiée avec succès.');
    }

    public function destroy(TransportRequest $transportRequest)
    {
    abort_unless($transportRequest->client_id === auth()->id(), 403);

    $transportRequest->delete();

    return redirect()
        ->route('transport-requests.index')
        ->with('success', 'Demande supprimée avec succès.');
    }
}