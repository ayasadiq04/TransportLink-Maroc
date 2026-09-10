<?php

namespace Tests\Feature;

use App\Models\TransportRequest;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContentSecurityPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_send_csp_header_without_inline_scripts(): void
    {
        foreach (['/', '/login', '/register'] as $uri) {
            $response = $this->get($uri);

            $response->assertOk();
            $response->assertHeader('Content-Security-Policy');

            $content = $response->getContent();
            $this->assertSame(0, $this->countInlineScripts($content), "Script inline sur $uri");
            $this->assertSame(0, $this->countInlineHandlers($content), "Handler inline sur $uri");
        }
    }

    public function test_authenticated_pages_send_csp_without_inline_scripts(): void
    {
        $client = User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
        $transportRequest = TransportRequest::factory()->create([
            'client_id' => $client->id,
            'status'    => 'pending',
        ]);
        $transporteur = User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);
        $vehicle = Vehicle::factory()->create(['transporteur_id' => $transporteur->id, 'available' => true]);

        $pages = [
            route('client.dashboard'),
            '/client/transport-requests',
            "/client/transport-requests/{$transportRequest->id}",
            '/client/offers',
            '/client/missions',
            '/profile',
            route('transporteur.dashboard'),
            "/transporteur/requests/{$transportRequest->id}",
            "/transporteur/requests/{$transportRequest->id}/offer",
            '/transporteur/missions',
            '/transporteur/vehicles',
        ];

        foreach ($pages as $uri) {
            $actingAs = $transporteur;
            if (str_contains($uri, '/client/')) {
                $actingAs = $client;
            }

            $response = $this->actingAs($actingAs)->get($uri);

            $response->assertOk();
            $response->assertHeader('Content-Security-Policy');

            $content = $response->getContent();
            $this->assertSame(0, $this->countInlineScripts($content), "Script inline sur $uri");
            $this->assertSame(0, $this->countInlineHandlers($content), "Handler inline sur $uri");
        }
    }

    private function countInlineScripts(string $content): int
    {
        return preg_match_all('/<script(?![^>]*\bsrc=)[^>]*>/i', $content);
    }

    private function countInlineHandlers(string $content): int
    {
        return preg_match_all('/\son(click|submit|change|input|load|error|focus|blur|keyup|keydown|dblclick|mouseover|mouseout)="/i', $content);
    }
}