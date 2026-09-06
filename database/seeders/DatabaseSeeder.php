<?php

namespace Database\Seeders;

use App\Models\Mission;
use App\Models\Offer;
use App\Models\Review;
use App\Models\TransportRequest;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Administrateur ──────────────────────────────────────────────────
        $admin = User::create([
            'name'     => 'Admin TransportLink',
            'email'    => 'admin@transportlink.ma',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // ─── Clients ──────────────────────────────────────────────────────────
        $client1 = User::create([
            'name'     => 'Youssef Bennani',
            'email'    => 'client1@transportlink.ma',
            'password' => Hash::make('password'),
            'role'     => 'client',
        ]);

        $client2 = User::create([
            'name'     => 'Fatima Zahra Alaoui',
            'email'    => 'client2@transportlink.ma',
            'password' => Hash::make('password'),
            'role'     => 'client',
        ]);

        $client3 = User::create([
            'name'     => 'Omar Tahiri',
            'email'    => 'client3@transportlink.ma',
            'password' => Hash::make('password'),
            'role'     => 'client',
        ]);

        // ─── Transporteurs ───────────────────────────────────────────────────
        $transporteur1 = User::create([
            'name'     => 'Hassan El Fassi',
            'email'    => 'transporteur1@transportlink.ma',
            'password' => Hash::make('password'),
            'role'     => 'transporteur',
        ]);

        $transporteur2 = User::create([
            'name'     => 'Rachid Moussaoui',
            'email'    => 'transporteur2@transportlink.ma',
            'password' => Hash::make('password'),
            'role'     => 'transporteur',
        ]);

        $transporteur3 = User::create([
            'name'     => 'Karim Benhaddou',
            'email'    => 'transporteur3@transportlink.ma',
            'password' => Hash::make('password'),
            'role'     => 'transporteur',
        ]);

        // ─── Véhicules ───────────────────────────────────────────────────────
        $vehicle1 = Vehicle::create([
            'transporteur_id'     => $transporteur1->id,
            'type'                => 'Camion frigorifique',
            'brand'               => 'Mercedes',
            'model'               => 'Actros',
            'registration_number' => 'A-12345-Casa',
            'capacity'            => 10.00,
            'available'           => true,
        ]);

        $vehicle2 = Vehicle::create([
            'transporteur_id'     => $transporteur1->id,
            'type'                => 'Fourgon',
            'brand'               => 'Renault',
            'model'               => 'Master',
            'registration_number' => 'B-67890-Casa',
            'capacity'            => 2.50,
            'available'           => true,
        ]);

        $vehicle3 = Vehicle::create([
            'transporteur_id'     => $transporteur2->id,
            'type'                => 'Camion plateau',
            'brand'               => 'Scania',
            'model'               => 'R450',
            'registration_number' => 'C-11223-Rabat',
            'capacity'            => 20.00,
            'available'           => true,
        ]);

        $vehicle4 = Vehicle::create([
            'transporteur_id'     => $transporteur2->id,
            'type'                => 'Camionnette',
            'brand'               => 'Peugeot',
            'model'               => 'Boxer',
            'registration_number' => 'D-44556-Rabat',
            'capacity'            => 1.50,
            'available'           => true,
        ]);

        $vehicle5 = Vehicle::create([
            'transporteur_id'     => $transporteur3->id,
            'type'                => 'Semi-remorque',
            'brand'               => 'Volvo',
            'model'               => 'FH16',
            'registration_number' => 'E-77889-Fes',
            'capacity'            => 25.00,
            'available'           => true,
        ]);

        // ─── Demandes de transport ────────────────────────────────────────────
        // Demandes PENDING (disponibles pour les transporteurs)
        $req1 = TransportRequest::create([
            'client_id'           => $client1->id,
            'title'               => 'Transport de marchandises Casablanca - Marrakech',
            'departure_city'      => 'Casablanca',
            'departure_address'   => '15 Rue Mohamed V, Ain Sebaa',
            'destination_city'    => 'Marrakech',
            'destination_address' => 'Zone industrielle Sidi Ghanem',
            'pickup_at'           => now()->addDays(3),
            'goods_type'          => 'palette',
            'weight'              => 5.00,
            'volume'              => 12.00,
            'instructions'        => 'Marchandises fragiles, manipulation avec soin.',
            'estimated_budget'    => 2500.00,
            'status'              => 'pending',
        ]);

        $req2 = TransportRequest::create([
            'client_id'           => $client2->id,
            'title'               => 'Livraison produits alimentaires Rabat - Fès',
            'departure_city'      => 'Rabat',
            'departure_address'   => 'Marché de gros, Hay Riad',
            'destination_city'    => 'Fès',
            'destination_address' => '42 Avenue Hassan II',
            'pickup_at'           => now()->addDays(5),
            'goods_type'          => 'frigorifique',
            'weight'              => 3.00,
            'volume'              => 8.00,
            'instructions'        => 'Produits frais, transport réfrigéré obligatoire.',
            'estimated_budget'    => 1800.00,
            'status'              => 'pending',
        ]);

        $req3 = TransportRequest::create([
            'client_id'           => $client3->id,
            'title'               => 'Déménagement matériel de bureau Casablanca - Tanger',
            'departure_city'      => 'Casablanca',
            'departure_address'   => 'Tour Anfa, Boulevard d\'Anfa',
            'destination_city'    => 'Tanger',
            'destination_address' => 'Zone Franche Tanger Med',
            'pickup_at'           => now()->addDays(7),
            'goods_type'          => 'colis_volumineux',
            'weight'              => 2.00,
            'volume'              => 15.00,
            'instructions'        => 'Bureaux, chaises, équipements informatiques.',
            'estimated_budget'    => 3200.00,
            'status'              => 'pending',
        ]);

        // Demande ACCEPTED (avec offre acceptée + mission)
        $req4 = TransportRequest::create([
            'client_id'           => $client1->id,
            'title'               => 'Transport vrac - Agadir vers Casablanca',
            'departure_city'      => 'Agadir',
            'departure_address'   => 'Port d\'Agadir',
            'destination_city'    => 'Casablanca',
            'destination_address' => 'Port de Casablanca',
            'pickup_at'           => now()->addDays(1),
            'goods_type'          => 'vrac',
            'weight'              => 18.00,
            'volume'              => 40.00,
            'instructions'        => null,
            'estimated_budget'    => 5000.00,
            'status'              => 'accepted',
        ]);

        // Demande COMPLETED
        $req5 = TransportRequest::create([
            'client_id'           => $client2->id,
            'title'               => 'Livraison liquide Meknès - Oujda',
            'departure_city'      => 'Meknès',
            'departure_address'   => 'Usine de mise en bouteille, Route de Fès',
            'destination_city'    => 'Oujda',
            'destination_address' => 'Entrepôt central, Boulevard Derfoufi',
            'pickup_at'           => now()->subDays(10),
            'goods_type'          => 'liquide',
            'weight'              => 8.00,
            'volume'              => 20.00,
            'instructions'        => 'Citernes hermétiques requises.',
            'estimated_budget'    => 3500.00,
            'status'              => 'accepted',
        ]);

        // ─── Offres ───────────────────────────────────────────────────────────
        // Offres pending sur req1
        $offer1 = Offer::create([
            'transport_request_id'   => $req1->id,
            'transporteur_id'        => $transporteur1->id,
            'vehicle_id'             => $vehicle1->id,
            'amount'                 => 2200.00,
            'message'                => 'Bonjour, je dispose d\'un camion adapté pour ce type de transport.',
            'conditions'             => 'Paiement 50% à l\'enlèvement, 50% à la livraison.',
            'estimated_delivery_time' => '2 jours',
            'status'                 => 'pending',
        ]);

        $offer2 = Offer::create([
            'transport_request_id'   => $req1->id,
            'transporteur_id'        => $transporteur2->id,
            'vehicle_id'             => $vehicle3->id,
            'amount'                 => 2400.00,
            'message'                => 'Service fiable et rapide, 5 ans d\'expérience.',
            'conditions'             => 'Paiement à la livraison.',
            'estimated_delivery_time' => '1 jour et demi',
            'status'                 => 'pending',
        ]);

        // Offre accepted sur req4 + mission créée
        $offer3 = Offer::create([
            'transport_request_id'   => $req4->id,
            'transporteur_id'        => $transporteur3->id,
            'vehicle_id'             => $vehicle5->id,
            'amount'                 => 4800.00,
            'message'                => 'Semi-remorque de 25 tonnes, idéal pour ce volume.',
            'conditions'             => 'Paiement avant enlèvement.',
            'estimated_delivery_time' => '1 jour',
            'status'                 => 'accepted',
        ]);

        // Marquer le véhicule 5 comme indisponible (mission en cours)
        $vehicle5->update(['available' => false]);

        // Mission créée pour req4
        $mission1 = Mission::create([
            'transport_request_id' => $req4->id,
            'offer_id'             => $offer3->id,
            'client_id'            => $client1->id,
            'transporteur_id'      => $transporteur3->id,
            'vehicle_id'           => $vehicle5->id,
            'status'               => 'in_delivery',
            'planned_at'           => now()->addDays(1),
            'delivered_at'         => null,
        ]);

        // Offre accepted sur req5 + mission terminée
        $offer4 = Offer::create([
            'transport_request_id'   => $req5->id,
            'transporteur_id'        => $transporteur1->id,
            'vehicle_id'             => $vehicle1->id,
            'amount'                 => 3300.00,
            'message'                => 'Camion frigorifique disponible pour ce trajet.',
            'conditions'             => 'Paiement à la livraison.',
            'estimated_delivery_time' => '3 jours',
            'status'                 => 'accepted',
        ]);

        // Mission livrée pour req5
        $mission2 = Mission::create([
            'transport_request_id' => $req5->id,
            'offer_id'             => $offer4->id,
            'client_id'            => $client2->id,
            'transporteur_id'      => $transporteur1->id,
            'vehicle_id'           => $vehicle1->id,
            'status'               => 'delivered',
            'planned_at'           => now()->subDays(10),
            'delivered_at'         => now()->subDays(7),
        ]);

        // ─── Évaluation ───────────────────────────────────────────────────────
        Review::create([
            'mission_id'      => $mission2->id,
            'client_id'       => $client2->id,
            'transporteur_id' => $transporteur1->id,
            'rating'          => 5,
            'comment'         => 'Excellent service ! Livraison rapide et soignée. Je recommande vivement.',
        ]);

        $this->command->info('✅ Base de données remplie avec succès !');
        $this->command->info('');
        $this->command->info('📋 Comptes de test :');
        $this->command->info('  Admin       : admin@transportlink.ma / password');
        $this->command->info('  Client 1    : client1@transportlink.ma / password');
        $this->command->info('  Client 2    : client2@transportlink.ma / password');
        $this->command->info('  Client 3    : client3@transportlink.ma / password');
        $this->command->info('  Transport 1 : transporteur1@transportlink.ma / password');
        $this->command->info('  Transport 2 : transporteur2@transportlink.ma / password');
        $this->command->info('  Transport 3 : transporteur3@transportlink.ma / password');
    }
}
