<?php

namespace Tests\Feature;

use App\Models\Mission;
use App\Models\Offer;
use App\Models\TransportRequest;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_full_workflow_request_to_delivery(): void
    {
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $transporteur = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);
        $vehicle = Vehicle::factory()->create(['transporteur_id' => $transporteur->id, 'available' => true]);

        $this->actingAs($client);

        $response = $this->post('/client/transport-requests', [
            'title'               => 'Colis fragile Rabat',
            'departure_city'      => 'Casablanca',
            'departure_address'   => '12 rue Hassan II',
            'destination_city'    => 'Rabat',
            'destination_address' => '5 avenue Mohammed V',
            'pickup_at'           => now()->addDays(2)->format('Y-m-d H:i'),
            'goods_type'          => 'palette',
            'weight'              => 250,
            'volume'              => 2,
            'estimated_budget'    => 2000,
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseCount('transport_requests', 1);
        $transportRequest = TransportRequest::first();
        $this->assertEquals('pending', $transportRequest->status);

        $this->actingAs($transporteur);

        $response = $this->post("/transporteur/requests/{$transportRequest->id}/offer", [
            'vehicle_id'              => $vehicle->id,
            'amount'                  => 1800,
            'message'                 => 'Disponible demain',
            'estimated_delivery_time' => '48h',
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseCount('offers', 1);
        $offer = Offer::first();
        $this->assertEquals('pending', $offer->status);
        $this->assertEquals($transporteur->id, $offer->transporteur_id);

        $this->actingAs($client);

        $this->post("/client/offers/{$offer->id}/accept")
            ->assertSessionHas('success');

        $this->assertSame('accepted', $offer->fresh()->status);
        $this->assertSame('accepted', $transportRequest->fresh()->status);
        $this->assertFalse($vehicle->fresh()->available);
        $this->assertDatabaseCount('missions', 1);
        $mission = Mission::first();
        $this->assertEquals($client->id, $mission->client_id);
        $this->assertEquals($transporteur->id, $mission->transporteur_id);
        $this->assertEquals($vehicle->id, $mission->vehicle_id);
        $this->assertEquals('pending', $mission->status);

        $this->actingAs($transporteur);

        $this->post("/transporteur/missions/{$mission->id}/status", ['status' => 'accepted'])
            ->assertSessionHas('success');

        $this->post("/transporteur/missions/{$mission->id}/status", ['status' => 'in_delivery'])
            ->assertSessionHas('success');

        $this->post("/transporteur/missions/{$mission->id}/status", ['status' => 'delivered'])
            ->assertSessionHas('success');

        $this->assertEquals('delivered', $mission->fresh()->status);
        $this->assertTrue($vehicle->fresh()->available);
        $this->assertNotNull($mission->fresh()->delivered_at);
    }

    public function test_accepting_offer_rejects_other_pending_offers(): void
    {
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $transporteur1 = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);
        $transporteur2 = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);
        $vehicle1 = Vehicle::factory()->create(['transporteur_id' => $transporteur1->id]);
        $vehicle2 = Vehicle::factory()->create(['transporteur_id' => $transporteur2->id]);

        $transportRequest = TransportRequest::factory()->create([
            'client_id' => $client->id,
            'status'    => 'pending',
        ]);

        $offer1 = Offer::factory()->create([
            'transport_request_id' => $transportRequest->id,
            'transporteur_id'      => $transporteur1->id,
            'vehicle_id'           => $vehicle1->id,
            'status'               => 'pending',
        ]);
        $offer2 = Offer::factory()->create([
            'transport_request_id' => $transportRequest->id,
            'transporteur_id'      => $transporteur2->id,
            'vehicle_id'           => $vehicle2->id,
            'status'               => 'pending',
        ]);

        $this->actingAs($client)
            ->post("/client/offers/{$offer1->id}/accept")
            ->assertSessionHas('success');

        $this->assertSame('accepted', $offer1->fresh()->status);
        $this->assertSame('rejected', $offer2->fresh()->status);
        $this->assertSame('accepted', $transportRequest->fresh()->status);
        $this->assertFalse($vehicle1->fresh()->available);
        $this->assertTrue($vehicle2->fresh()->available);
    }
}