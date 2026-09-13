<?php

namespace Tests\Feature;

use App\Models\Offer;
use App\Models\TransportRequest;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewRenderTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_transport_request_pages_render(): void
    {
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $transportRequest = TransportRequest::factory()->create([
            'client_id' => $client->id,
            'status'    => 'pending',
        ]);

        $this->actingAs($client);

        $this->get('/client/transport-requests')->assertOk();
        $this->get('/client/transport-requests/create')->assertOk();
        $this->get("/client/transport-requests/{$transportRequest->id}")->assertOk();
        $this->get("/client/transport-requests/{$transportRequest->id}/edit")->assertOk();
    }

    public function test_offer_creation_page_renders_for_transporteur(): void
    {
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $transporteur = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);
        $vehicle = Vehicle::factory()->create(['transporteur_id' => $transporteur->id, 'available' => true]);

        $transportRequest = TransportRequest::factory()->create([
            'client_id' => $client->id,
            'status'    => 'pending',
        ]);

        $this->actingAs($transporteur)
            ->get("/transporteur/requests/{$transportRequest->id}/offer")
            ->assertOk();
    }

    public function test_admin_list_pages_render(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'email_verified_at' => now()]);
        User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);

        $this->actingAs($admin);

        $this->get('/admin/dashboard')->assertOk();
        $this->get('/admin/users')->assertOk();
        $this->get('/admin/transport-requests')->assertOk();
        $this->get('/admin/offers')->assertOk();
        $this->get('/admin/missions')->assertOk();
    }

    public function test_admin_cannot_delete_user_with_active_mission(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'email_verified_at' => now()]);
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

        $this->actingAs($admin)
            ->delete("/admin/users/{$client->id}")
            ->assertSessionHas('error');

        $this->assertDatabaseCount('users', 3);
    }

    public function test_admin_can_toggle_user_status_and_cannot_toggle_self(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'email_verified_at' => now(), 'active' => true]);
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now(), 'active' => true]);

        $this->actingAs($admin)
            ->patch("/admin/users/{$client->id}/toggle")
            ->assertSessionHas('success');

        $this->assertFalse((bool) $client->fresh()->active);

        $this->actingAs($admin)
            ->patch("/admin/users/{$client->id}/toggle")
            ->assertSessionHas('success');

        $this->assertTrue((bool) $client->fresh()->active);

        $this->actingAs($admin)
            ->patch("/admin/users/{$admin->id}/toggle")
            ->assertSessionHas('error');

        $this->assertTrue((bool) $admin->fresh()->active);
    }

    public function test_client_transport_requests_index_is_paginated(): void
    {
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);

        TransportRequest::factory()->count(20)->create([
            'client_id' => $client->id,
        ]);

        $response = $this->actingAs($client)->get(route('client.transport-requests.index'));

        $response->assertOk();
        $response->assertViewHas('requests');
        $requests = $response->viewData('requests');
        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $requests);
        $this->assertEquals(20, $requests->total());
        $this->assertEquals(15, $requests->perPage());
    }
}