<?php

namespace Tests\Feature;

use App\Models\TransportRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Le /api/user et /api/me exigent un token Sanctum valide.
     */
    public function test_api_requires_authentication(): void
    {
        $this->getJson('/api/me')->assertStatus(401);
        $this->getJson('/api/transport-requests/available')->assertStatus(401);
    }

    /**
     * Un transporteur avec token peut lire /api/me.
     */
    public function test_transporteur_can_read_me_with_token(): void
    {
        $transporteur = User::factory()->create(['role' => 'transporteur']);
        $token = $transporteur->createToken('api')->plainTextToken;

        $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/me')
            ->assertStatus(200)
            ->assertJsonPath('role', 'transporteur');
    }

    /**
     * Un client ne peut pas accéder aux demandes disponibles (rôle requis).
     */
    public function test_client_cannot_access_available_requests(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $token = $client->createToken('api')->plainTextToken;

        $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/transport-requests/available')
            ->assertStatus(403);
    }

    /**
     * Un transporteur peut lister les demandes disponibles via l'API.
     */
    public function test_transporteur_can_list_available_requests(): void
    {
        $transporteur = User::factory()->create(['role' => 'transporteur']);
        $token = $transporteur->createToken('api')->plainTextToken;

        TransportRequest::create([
            'client_id'           => User::factory()->create(['role' => 'client'])->id,
            'title'               => 'Transport API',
            'departure_city'      => 'Casablanca',
            'departure_address'   => 'Ain Sebaa',
            'destination_city'    => 'Rabat',
            'destination_address' => 'Agdal',
            'pickup_at'           => now()->addDays(2),
            'goods_type'          => 'palette',
            'weight'              => 2.5,
            'status'              => 'pending',
        ]);

        $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/transport-requests/available')
            ->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    /**
     * Les filtres de recherche fonctionnent via l'API.
     */
    public function test_api_available_requests_filters(): void
    {
        $transporteur = User::factory()->create(['role' => 'transporteur']);
        $token = $transporteur->createToken('api')->plainTextToken;

        TransportRequest::create([
            'client_id'           => User::factory()->create(['role' => 'client'])->id,
            'title'               => 'Vers Marrakech',
            'departure_city'      => 'Casablanca',
            'departure_address'   => 'Ain Sebaa',
            'destination_city'    => 'Marrakech',
            'destination_address' => 'Guéliz',
            'pickup_at'           => now()->addDays(3),
            'goods_type'          => 'vrac',
            'weight'              => 6.0,
            'status'              => 'pending',
        ]);

        TransportRequest::create([
            'client_id'           => User::factory()->create(['role' => 'client'])->id,
            'title'               => 'Vers Tanger (liquidé)',
            'departure_city'      => 'Casablanca',
            'departure_address'   => 'Ain Sebaa',
            'destination_city'    => 'Tanger',
            'destination_address' => 'Centre',
            'pickup_at'           => now()->addDays(3),
            'goods_type'          => 'palette',
            'weight'              => 1.0,
            'status'              => 'accepted',
        ]);

        $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/transport-requests/available?arrival=Marrakech')
            ->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    /**
     * Le rate limiter API limite les requêtes au-delà de 60/min.
     */
    public function test_api_is_rate_limited(): void
    {
        $transporteur = User::factory()->create(['role' => 'transporteur']);
        $token = $transporteur->createToken('api')->plainTextToken;

        foreach (range(1, 60) as $i) {
            $this->withHeader('Authorization', "Bearer $token")->getJson('/api/me');
        }

        $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/me')
            ->assertStatus(429);
    }
}