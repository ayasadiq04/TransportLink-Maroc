<?php

namespace Tests\Feature;

use App\Models\Mission;
use App\Models\Offer;
use App\Models\TransportRequest;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkflowIntegrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test 1: Voir la demande button & authorization.
     * Transporteur can view pending request, or request where he has offer/mission.
     */
    public function test_carrier_and_client_can_access_voir_la_demande(): void
    {
        $client = User::where('role', 'client')->first() ?? User::factory()->create(['role' => 'client']);
        $carrier = User::where('role', 'transporteur')->first() ?? User::factory()->create(['role' => 'transporteur']);
        
        $vehicle = Vehicle::where('transporteur_id', $carrier->id)->first();
        if (!$vehicle) {
            $vehicle = Vehicle::create([
                'transporteur_id'     => $carrier->id,
                'type'                => 'Fourgon',
                'brand'               => 'Mercedes',
                'model'               => 'Sprinter',
                'registration_number' => 'TEST-123-MA',
                'capacity'            => 3.5,
                'available'           => true,
            ]);
        }

        // Demande créée par le client
        $request = TransportRequest::create([
            'client_id'           => $client->id,
            'title'               => 'Transport de marchandises Test',
            'departure_city'      => 'Casablanca',
            'departure_address'   => 'Ain Sebaa',
            'destination_city'    => 'Rabat',
            'destination_address' => 'Agdal',
            'pickup_at'           => now()->addDays(2),
            'goods_type'          => 'palette',
            'weight'              => 2.5,
            'status'              => 'pending',
        ]);

        // 1. Client views request
        $response = $this->actingAs($client)->get(route('client.transport-requests.show', $request));
        $response->assertStatus(200);

        // 2. Carrier views request (pending)
        $response = $this->actingAs($carrier)->get(route('transporteur.requests.show', $request));
        $response->assertStatus(200);

        // 3. Carrier creates offer
        $response = $this->actingAs($carrier)->post(route('transporteur.offers.store', $request), [
            'vehicle_id'              => $vehicle->id,
            'amount'                  => 1500,
            'message'                 => 'Offre rapide et soignée',
            'estimated_delivery_time' => '24h',
        ]);
        $response->assertRedirect(route('transporteur.offers.index'));

        // Verify offer exists in DB
        $offer = Offer::where('transport_request_id', $request->id)->where('transporteur_id', $carrier->id)->first();
        $this->assertNotNull($offer);
        $this->assertEquals(1500, $offer->amount);

        // 4. "Mes offres" retrieves offer
        $response = $this->actingAs($carrier)->get(route('transporteur.offers.index'));
        $response->assertStatus(200);
        $response->assertSee('Transport de marchandises Test');

        // 5. Client views offers and accepts
        $response = $this->actingAs($client)->get(route('client.offers.index'));
        $response->assertStatus(200);
        $response->assertSee('Voir la demande');

        $acceptResponse = $this->actingAs($client)->post(route('client.offers.accept', $offer));
        $acceptResponse->assertRedirect(route('client.missions.index'));

        // Verify Request is accepted and Mission is created
        $request->refresh();
        $offer->refresh();
        $this->assertEquals('accepted', $request->status);
        $this->assertEquals('accepted', $offer->status);

        $mission = Mission::where('transport_request_id', $request->id)->first();
        $this->assertNotNull($mission);
        $this->assertEquals($carrier->id, $mission->transporteur_id);

        // 6. Carrier clicks "Voir la demande" now that request is accepted -> must NOT 404
        $response = $this->actingAs($carrier)->get(route('transporteur.requests.show', $request));
        $response->assertStatus(200);
        $response->assertSee('Transport de marchandises Test');

        // 7. Update Mission Status through allowed workflow
        // Pending -> in_delivery
        $response = $this->actingAs($carrier)->patch(route('transporteur.missions.update-status', $mission), [
            'status' => 'in_delivery',
        ]);
        $response->assertRedirect(route('transporteur.missions.show', $mission));

        $mission->refresh();
        $this->assertEquals('in_delivery', $mission->status);

        // in_delivery -> delivered
        $response = $this->actingAs($carrier)->patch(route('transporteur.missions.update-status', $mission), [
            'status' => 'delivered',
        ]);
        $response->assertRedirect(route('transporteur.missions.show', $mission));

        $mission->refresh();
        $request->refresh();
        $this->assertEquals('delivered', $mission->status);
        $this->assertNotNull($mission->delivered_at);
        $this->assertEquals('completed', $request->status);

        // 8. Filters on Available Requests
        $response = $this->actingAs($carrier)->get(route('transporteur.requests.index', [
            'departure' => 'NonExistentCityXYZ',
        ]));
        $response->assertStatus(200);
        $response->assertSee('Aucune demande disponible');
    }
}
