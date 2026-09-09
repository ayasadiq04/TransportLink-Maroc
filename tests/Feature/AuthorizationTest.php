<?php

namespace Tests\Feature;

use App\Models\Offer;
use App\Models\TransportRequest;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_cannot_view_another_clients_request(): void
    {
        $owner = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $other = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $transportRequest = TransportRequest::factory()->create(['client_id' => $owner->id]);

        $this->actingAs($other)
            ->get("/client/transport-requests/{$transportRequest->id}")
            ->assertForbidden();

        $this->actingAs($other)
            ->get("/client/transport-requests/{$transportRequest->id}/edit")
            ->assertForbidden();

        $this->actingAs($other)
            ->delete("/client/transport-requests/{$transportRequest->id}")
            ->assertForbidden();
    }

    public function test_transporteur_cannot_see_request_content_when_not_pending(): void
    {
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $transporteur = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);
        $transportRequest = TransportRequest::factory()->create([
            'client_id' => $client->id,
            'status'    => 'accepted',
        ]);

        $this->actingAs($transporteur)
            ->get("/transporteur/requests/{$transportRequest->id}")
            ->assertForbidden();
    }

    public function test_transporteur_cannot_offer_on_another_transporteur_vehicle(): void
    {
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $transporteur = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);
        $otherVehicle = Vehicle::factory()->create(['transporteur_id' => User::factory()->create(['role' => 'transporteur'])->id]);
        $transportRequest = TransportRequest::factory()->create([
            'client_id' => $client->id,
            'status'    => 'pending',
        ]);

        $this->actingAs($transporteur)
            ->post("/transporteur/requests/{$transportRequest->id}/offer", [
                'vehicle_id' => $otherVehicle->id,
                'amount'     => 1500,
            ])
            ->assertSessionHasErrors('vehicle_id');

        $this->assertDatabaseCount('offers', 0);
    }

    public function test_client_cannot_accept_another_request_offer(): void
    {
        $owner = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $other = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $transporteur = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);
        $vehicle = Vehicle::factory()->create(['transporteur_id' => $transporteur->id]);

        $transportRequest = TransportRequest::factory()->create([
            'client_id' => $owner->id,
            'status'    => 'pending',
        ]);
        $offer = Offer::factory()->create([
            'transport_request_id' => $transportRequest->id,
            'transporteur_id'      => $transporteur->id,
            'vehicle_id'           => $vehicle->id,
            'status'               => 'pending',
        ]);

        $this->actingAs($other)
            ->post("/client/offers/{$offer->id}/accept")
            ->assertForbidden();

        $this->assertSame('pending', $offer->fresh()->status);
        $this->assertDatabaseCount('missions', 0);
    }

    public function test_transporteur_cannot_update_status_of_another_transporteur_mission(): void
    {
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $transporteur1 = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);
        $transporteur2 = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);
        $vehicle = Vehicle::factory()->create(['transporteur_id' => $transporteur1->id]);

        $transportRequest = TransportRequest::factory()->create([
            'client_id' => $client->id,
            'status'    => 'accepted',
        ]);
        $offer = Offer::factory()->create([
            'transport_request_id' => $transportRequest->id,
            'transporteur_id'      => $transporteur1->id,
            'vehicle_id'           => $vehicle->id,
            'status'               => 'accepted',
        ]);
        $mission = \App\Models\Mission::factory()->create([
            'transport_request_id' => $transportRequest->id,
            'offer_id'             => $offer->id,
            'client_id'            => $client->id,
            'transporteur_id'      => $transporteur1->id,
            'vehicle_id'           => $vehicle->id,
            'status'               => 'accepted',
        ]);

        $this->actingAs($transporteur2)
            ->post("/transporteur/missions/{$mission->id}/status", ['status' => 'delivered'])
            ->assertForbidden();

        $this->assertSame('accepted', $mission->fresh()->status);
    }
}