<?php

namespace Tests\Feature;

use App\Models\Offer;
use App\Models\TransportRequest;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeletionProtectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_transporteur_cannot_delete_vehicle_used_in_active_mission(): void
    {
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $transporteur = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);
        $vehicle = Vehicle::factory()->create(['transporteur_id' => $transporteur->id]);

        $transportRequest = TransportRequest::factory()->create([
            'client_id' => $client->id,
            'status'    => 'accepted',
        ]);
        $offer = Offer::factory()->create([
            'transport_request_id' => $transportRequest->id,
            'transporteur_id'      => $transporteur->id,
            'vehicle_id'           => $vehicle->id,
            'status'               => 'accepted',
        ]);
        \App\Models\Mission::factory()->create([
            'transport_request_id' => $transportRequest->id,
            'offer_id'             => $offer->id,
            'client_id'            => $client->id,
            'transporteur_id'      => $transporteur->id,
            'vehicle_id'           => $vehicle->id,
            'status'               => 'in_delivery',
        ]);

        $this->actingAs($transporteur)
            ->delete("/transporteur/vehicles/{$vehicle->id}")
            ->assertSessionHas('error');

        $this->assertDatabaseCount('vehicles', 1);
    }

    public function test_transporteur_cannot_delete_vehicle_with_mission_history(): void
    {
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $transporteur = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);
        $vehicle = Vehicle::factory()->create(['transporteur_id' => $transporteur->id]);

        $transportRequest = TransportRequest::factory()->create([
            'client_id' => $client->id,
            'status'    => 'completed',
        ]);
        $offer = Offer::factory()->create([
            'transport_request_id' => $transportRequest->id,
            'transporteur_id'      => $transporteur->id,
            'vehicle_id'           => $vehicle->id,
            'status'               => 'accepted',
        ]);
        // Mission terminée (historique, plus active)
        $mission = \App\Models\Mission::factory()->create([
            'transport_request_id' => $transportRequest->id,
            'offer_id'             => $offer->id,
            'client_id'            => $client->id,
            'transporteur_id'      => $transporteur->id,
            'vehicle_id'           => $vehicle->id,
            'status'               => 'delivered',
        ]);

        $this->actingAs($transporteur)
            ->delete("/transporteur/vehicles/{$vehicle->id}")
            ->assertSessionHas('error');

        $this->assertDatabaseCount('vehicles', 1);
        $this->assertDatabaseCount('missions', 1);
    }

    public function test_transporteur_cannot_delete_vehicle_with_offer_history(): void
    {
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $transporteur = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);
        $vehicle = Vehicle::factory()->create(['transporteur_id' => $transporteur->id]);

        $transportRequest = TransportRequest::factory()->create([
            'client_id' => $client->id,
            'status'    => 'pending',
        ]);
        Offer::factory()->create([
            'transport_request_id' => $transportRequest->id,
            'transporteur_id'      => $transporteur->id,
            'vehicle_id'           => $vehicle->id,
            'status'               => 'rejected',
        ]);

        $this->actingAs($transporteur)
            ->delete("/transporteur/vehicles/{$vehicle->id}")
            ->assertSessionHas('error');

        $this->assertDatabaseCount('vehicles', 1);
    }

    public function test_transporteur_can_delete_vehicle_without_active_mission(): void
    {
        $transporteur = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);
        $vehicle = Vehicle::factory()->create(['transporteur_id' => $transporteur->id]);

        $this->actingAs($transporteur)
            ->delete("/transporteur/vehicles/{$vehicle->id}")
            ->assertSessionHas('success');

        $this->assertDatabaseCount('vehicles', 0);
    }

    public function test_client_cannot_delete_account_with_active_mission(): void
    {
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $transporteur = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);
        $vehicle = Vehicle::factory()->create(['transporteur_id' => $transporteur->id]);

        $transportRequest = TransportRequest::factory()->create([
            'client_id' => $client->id,
            'status'    => 'accepted',
        ]);
        $offer = Offer::factory()->create([
            'transport_request_id' => $transportRequest->id,
            'transporteur_id'      => $transporteur->id,
            'vehicle_id'           => $vehicle->id,
            'status'               => 'accepted',
        ]);
        \App\Models\Mission::factory()->create([
            'transport_request_id' => $transportRequest->id,
            'offer_id'             => $offer->id,
            'client_id'            => $client->id,
            'transporteur_id'      => $transporteur->id,
            'vehicle_id'           => $vehicle->id,
            'status'               => 'accepted',
        ]);

        $this->actingAs($client)
            ->delete('/profile', ['password' => 'password'])
            ->assertRedirect('/profile');

        $this->assertDatabaseCount('users', 2);
    }

    public function test_client_can_delete_account_without_active_mission(): void
    {
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);

        $this->actingAs($client)
            ->delete('/profile', ['password' => 'password'])
            ->assertRedirect('/');

        $this->assertDatabaseCount('users', 0);
    }
}