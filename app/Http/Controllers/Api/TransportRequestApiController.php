<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransportRequestApiController extends Controller
{
    /**
     * Listes les demandes de transport disponibles (status pending) pour les transporteurs.
     * Requiert un token Sanctum et le rôle 'transporteur'.
     */
    public function available(): JsonResponse
    {
        $requests = \App\Models\TransportRequest::where('status', 'pending')
            ->withCount('offers')
            ->latest()
            ->paginate(15);

        return response()->json($requests);
    }

    /**
     * Retourne l'utilisateur connecté et ses données utiles.
     */
    public function me(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'id'           => $user->id,
            'name'         => $user->name,
            'email'        => $user->email,
            'role'         => $user->role,
            'created_at'   => $user->created_at,
        ]);
    }
}