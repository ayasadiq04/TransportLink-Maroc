<?php

namespace Tests\Feature;

use App\Models\Mission;
use App\Models\Offer;
use App\Models\TransportRequest;
use App\Models\User;
use App\Models\Vehicle;
use App\Notifications\MissionStatusUpdatedNotification;
use App\Notifications\NewOfferNotification;
use App\Notifications\NewTransportRequestNotification;
use App\Notifications\OfferAcceptedNotification;
use App\Notifications\OfferRejectedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    private function createClient(): User
    {
        return User::factory()->create(['role' => 'client', 'email_verified_at' => now()]);
    }

    private function createTransporteur(): User
    {
        return User::factory()->create(['role' => 'transporteur', 'email_verified_at' => now()]);
    }

    private function createPendingRequest(User $client): TransportRequest
    {
        return TransportRequest::factory()->create([
            'client_id' => $client->id,
            'status'    => 'pending',
        ]);
    }

    private function createOffer(User $transporteur, TransportRequest $request): Offer
    {
        $vehicle = Vehicle::factory()->create(['transporteur_id' => $transporteur->id]);

        return Offer::factory()->create([
            'transport_request_id' => $request->id,
            'transporteur_id'      => $transporteur->id,
            'vehicle_id'           => $vehicle->id,
            'status'               => 'pending',
        ]);
    }

    /**
     * 1. Client crée une demande → les transporteurs reçoivent NewTransportRequestNotification.
     */
    public function test_creating_request_notifies_all_transporteurs(): void
    {
        Notification::fake();

        $client = $this->createClient();
        $transporteur1 = $this->createTransporteur();
        $transporteur2 = $this->createTransporteur();
        $admin = User::factory()->create(['role' => 'admin', 'email_verified_at' => now()]);

        $this->actingAs($client)->post('/client/transport-requests', [
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
        ])->assertSessionHasNoErrors();

        Notification::assertSentTo($transporteur1, NewTransportRequestNotification::class);
        Notification::assertSentTo($transporteur2, NewTransportRequestNotification::class);
        Notification::assertNotSentTo($client, NewTransportRequestNotification::class);
        Notification::assertNotSentTo($admin, NewTransportRequestNotification::class);
    }

    /**
     * 2. Transporteur fait une offre → le client reçoit NewOfferNotification.
     */
    public function test_creating_offer_notifies_request_client(): void
    {
        Notification::fake();

        $client = $this->createClient();
        $transporteur = $this->createTransporteur();
        $request = $this->createPendingRequest($client);
        $vehicle = Vehicle::factory()->create(['transporteur_id' => $transporteur->id]);

        $this->actingAs($transporteur)->post("/transporteur/requests/{$request->id}/offer", [
            'vehicle_id'              => $vehicle->id,
            'amount'                  => 1500,
            'message'                 => 'Disponible',
            'estimated_delivery_time' => '48h',
        ])->assertSessionHasNoErrors();

        Notification::assertSentTo($client, NewOfferNotification::class);
        Notification::assertNotSentTo($transporteur, NewOfferNotification::class);
    }

    /**
     * 3. Client accepte une offre → le transporteur reçoit OfferAcceptedNotification.
     */
    public function test_accepting_offer_notifies_transporteur(): void
    {
        Notification::fake();

        $client = $this->createClient();
        $transporteur = $this->createTransporteur();
        $request = $this->createPendingRequest($client);
        $offer = $this->createOffer($transporteur, $request);

        $this->actingAs($client)->post("/client/offers/{$offer->id}/accept")
            ->assertSessionHas('success');

        Notification::assertSentTo($transporteur, OfferAcceptedNotification::class);
        Notification::assertSentTo($transporteur, OfferAcceptedNotification::class, 1);
        Notification::assertNotSentTo($client, OfferAcceptedNotification::class);
    }

    /**
     * 4. Client rejette une offre → le transporteur reçoit OfferRejectedNotification.
     */
    public function test_rejecting_offer_notifies_transporteur(): void
    {
        Notification::fake();

        $client = $this->createClient();
        $transporteur = $this->createTransporteur();
        $request = $this->createPendingRequest($client);
        $offer = $this->createOffer($transporteur, $request);

        $this->actingAs($client)->post("/client/offers/{$offer->id}/reject")
            ->assertSessionHas('success');

        Notification::assertSentTo($transporteur, OfferRejectedNotification::class);
        Notification::assertNotSentTo($client, OfferRejectedNotification::class);
    }

    /**
     * 5. Changement de statut par le transporteur → le client reçoit MissionStatusUpdatedNotification.
     */
    public function test_status_change_notifies_client(): void
    {
        Notification::fake();

        $client = $this->createClient();
        $transporteur = $this->createTransporteur();
        $request = $this->createPendingRequest($client);
        $offer = $this->createOffer($transporteur, $request);
        $mission = Mission::factory()->create([
            'transport_request_id' => $request->id,
            'offer_id'             => $offer->id,
            'client_id'            => $client->id,
            'transporteur_id'      => $transporteur->id,
            'vehicle_id'           => $offer->vehicle_id,
            'status'               => 'pending',
        ]);

        $this->actingAs($transporteur)->post("/transporteur/missions/{$mission->id}/status", [
            'status' => 'accepted',
        ])->assertSessionHas('success');

        Notification::assertSentTo(
            $client,
            MissionStatusUpdatedNotification::class,
            function ($notification) {
                return $notification->status === 'accepted';
            }
        );
        Notification::assertNotSentTo($transporteur, MissionStatusUpdatedNotification::class);
    }

    /**
     * 6. Livraison (delivered) → le client reçoit MissionStatusUpdatedNotification.
     */
    public function test_delivered_status_notifies_client(): void
    {
        Notification::fake();

        $client = $this->createClient();
        $transporteur = $this->createTransporteur();
        $request = $this->createPendingRequest($client);
        $offer = $this->createOffer($transporteur, $request);
        $mission = Mission::factory()->create([
            'transport_request_id' => $request->id,
            'offer_id'             => $offer->id,
            'client_id'            => $client->id,
            'transporteur_id'      => $transporteur->id,
            'vehicle_id'           => $offer->vehicle_id,
            'status'               => 'in_delivery',
        ]);

        $this->actingAs($transporteur)->post("/transporteur/missions/{$mission->id}/status", [
            'status' => 'delivered',
        ])->assertSessionHas('success');

        Notification::assertSentTo(
            $client,
            MissionStatusUpdatedNotification::class,
            function ($notification) {
                return $notification->status === 'delivered';
            }
        );
    }

    /**
     * 7. Un utilisateur ne peut pas lire/modifier les notifications d'un autre utilisateur.
     */
    public function test_user_cannot_access_others_notifications(): void
    {
        $client = $this->createClient();
        $other = $this->createTransporteur();
        $request = $this->createPendingRequest($client);

        $client->notify(new NewTransportRequestNotification($request));
        $notification = $client->notifications()->first();

        $this->actingAs($other)
            ->post(route('notifications.read', $notification->id))
            ->assertForbidden();

        $this->assertNull($notification->fresh()->read_at);

        $this->actingAs($other)
            ->get(route('notifications.index'))
            ->assertOk()
            ->assertDontSee('Nouvelle demande de transport');
    }

    /**
     * 8. Le compteur de notifications non lues fonctionne.
     */
    public function test_unread_counter_works(): void
    {
        $client = $this->createClient();
        $request = $this->createPendingRequest($client);

        $client->notify(new NewTransportRequestNotification($request));
        $client->notify(new NewTransportRequestNotification($request));

        $this->assertSame(2, $client->unreadNotifications()->count());

        $this->actingAs($client)
            ->get(route('notifications.index'))
            ->assertOk()
            ->assertSee('Nouvelle demande de transport')
            ->assertSee('2');
    }

    /**
     * 9. Marquer une notification comme lue fonctionne.
     */
    public function test_mark_as_read_works(): void
    {
        $client = $this->createClient();
        $request = $this->createPendingRequest($client);

        $client->notify(new NewTransportRequestNotification($request));
        $notification = $client->notifications()->first();

        $this->from(route('notifications.index'))
            ->actingAs($client)
            ->post(route('notifications.read', $notification->id))
            ->assertRedirect(route('notifications.index'));

        $this->assertNotNull($notification->fresh()->read_at);
        $this->assertSame(0, $client->unreadNotifications()->count());
    }

    /**
     * 10. Marquer toutes les notifications comme lues fonctionne.
     */
    public function test_mark_all_as_read_works(): void
    {
        $client = $this->createClient();
        $request = $this->createPendingRequest($client);

        $client->notify(new NewTransportRequestNotification($request));
        $client->notify(new NewTransportRequestNotification($request));

        $this->from(route('notifications.index'))
            ->actingAs($client)
            ->post(route('notifications.read-all'))
            ->assertRedirect(route('notifications.index'));

        $this->assertSame(0, $client->unreadNotifications()->count());
        $this->assertDatabaseCount('notifications', 2);
        $this->assertSame(2, $client->readNotifications()->count());
    }
}