<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchAvailableTransportRequestsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransportRequestApiController extends Controller
{
    /**
     * Listes les demandes de transport disponibles pour les transporteurs.
     * Requiert un token Sanctum et le rôle 'transporteur'.
     */
    public function available(SearchAvailableTransportRequestsRequest $request): JsonResponse
    {
        $filters = $request->filters();

        $query = \App\Models\TransportRequest::where('status', $filters['status'])
            ->withCount('offers');

        if ($filters['departure'] !== '') {
            $query->where('departure_city', 'like', '%' . $filters['departure'] . '%');
        }

        if ($filters['arrival'] !== '') {
            $query->where('destination_city', 'like', '%' . $filters['arrival'] . '%');
        }

        if ($filters['cargo'] !== '') {
            $query->where(function ($q) use ($filters) {
                $q->where('goods_type', 'like', '%' . $filters['cargo'] . '%')
                  ->orWhere('title', 'like', '%' . $filters['cargo'] . '%');
            });
        } elseif ($filters['goods_type'] !== null) {
            $query->where('goods_type', $filters['goods_type']);
        }

        if ($filters['weight_min'] !== null) {
            $query->where('weight', '>=', $filters['weight_min']);
        }

        if ($filters['weight_max'] !== null) {
            $query->where('weight', '<=', $filters['weight_max']);
        }

        if ($filters['pickup_date'] !== null) {
            $query->whereDate('pickup_at', $filters['pickup_date']);
        }

        $requests = $query->latest()->paginate(15);

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