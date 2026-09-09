<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_role_middleware_blocks_client_from_transporteur_routes(): void
    {
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);

        $this->actingAs($client)
            ->get('/transporteur/dashboard')
            ->assertForbidden();

        $this->actingAs($client)
            ->get('/transporteur/vehicles')
            ->assertForbidden();
    }

    public function test_role_middleware_blocks_transporteur_from_client_routes(): void
    {
        $transporteur = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);

        $this->actingAs($transporteur)
            ->get('/client/dashboard')
            ->assertForbidden();

        $this->actingAs($transporteur)
            ->get('/client/transport-requests')
            ->assertForbidden();
    }

    public function test_role_middleware_blocks_non_admin_from_admin_panel(): void
    {
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $transporteur = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);

        $this->actingAs($client)->get('/admin/dashboard')->assertForbidden();
        $this->actingAs($transporteur)->get('/admin/users')->assertForbidden();
    }

    public function test_dashboard_redirects_by_role(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'email_verified_at' => now()]);
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $transporteur = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);

        $this->actingAs($admin)->get('/dashboard')->assertRedirect('/admin/dashboard');
        $this->actingAs($client)->get('/dashboard')->assertRedirect('/client/dashboard');
        $this->actingAs($transporteur)->get('/dashboard')->assertRedirect('/transporteur/dashboard');
    }
}