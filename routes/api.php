<?php

use App\Http\Controllers\Api\TransportRequestApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [TransportRequestApiController::class, 'me']);

        // Demandes disponibles — réservées au rôle transporteur
        Route::get('/transport-requests/available', [TransportRequestApiController::class, 'available'])
            ->middleware('role:transporteur');
    });
});