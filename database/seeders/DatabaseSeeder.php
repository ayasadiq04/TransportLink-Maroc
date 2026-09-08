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
        $admin = User::firstOrCreate(
            ['email' => 'admin@transportlink.ma'],
            [
                'name'     => 'Admin TransportLink',
                'password' => Hash::make('password'),
                'role'     => 'admin',
                'phone'    => '+212 6 00 00 00 00',
                'city'     => 'Casablanca',
            ]
        );

        // ─── Clients ──────────────────────────────────────────────────────────
        $client1 = User::firstOrCreate(
            ['email' => 'client1@transportlink.ma'],
            [
                'name'     => 'Youssef Bennani',
                'password' => Hash::make('password'),
                'role'     => 'client',
                'phone'    => '+212 6 11 11 11 11',
                'city'     => 'Casablanca',
            ]
        );

        $client2 = User::firstOrCreate(
            ['email' => 'client2@transportlink.ma'],
            [
                'name'     => 'Fatima Zahra Alaoui',
                'password' => Hash::make('password'),
                'role'     => 'client',
                'phone'    => '+212 6 22 22 22 22',
                'city'     => 'Rabat',
            ]
        );

        $client3 = User::firstOrCreate(
            ['email' => 'client3@transportlink.ma'],
            [
                'name'     => 'Omar Tahiri',
                'password' => Hash::make('password'),
                'role'     => 'client',
                'phone'    => '+212 6 33 33 33 33',
                'city'     => 'Casablanca',
            ]
        );

        // ─── Transporteurs ───────────────────────────────────────────────────
        $transporteur1 = User::firstOrCreate(
            ['email' => 'transporteur1@transportlink.ma'],
            [
                'name'     => 'Hassan El Fassi',
                'password' => Hash::make('password'),
                'role'     => 'transporteur',
                'phone'    => '+212 6 44 44 44 44',
                'city'     => 'Casablanca',
            ]
        );

        $transporteur2 = User::firstOrCreate(
            ['email' => 'transporteur2@transportlink.ma'],
            [
                'name'     => 'Rachid Moussaoui',
                'password' => Hash::make('password'),
                'role'     => 'transporteur',
                'phone'    => '+212 6 55 55 55 55',
                'city'     => 'Rabat',
            ]
        );

        $transporteur3 = User::firstOrCreate(
            ['email' => 'transporteur3@transportlink.ma'],
            [
                'name'     => 'Karim Benhaddou',
                'password' => Hash::make('password'),
                'role'     => 'transporteur',
                'phone'    => '+212 6 66 66 66 66',
                'city'     => 'Fès',
            ]
        );

        // ─── Vehicules ───────────────────────────────────────────────────────
        $vehicle1 = Vehicle::firstOrCreate(
            ['registration_number' => 'A-12345-Casa'],
            [
                'transporteur_id' => $transporteur1->id,
                'type'            => 'Camion frigorifique',
                'brand'           => 'Mercedes',
                'model'           => 'Actros',
                'capacity'        => 10.00,
                'available'       => true,
            ]
        );

        $vehicle2 = Vehicle::firstOrCreate(
            ['registration_number' => 'B-67890-Casa'],
            [
                'transporteur_id' => $transporteur1->id,
                'type'            => 'Fourgon',
                'brand'           => 'Renault',
                'model'           => 'Master',
                'capacity'        => 2.50,
                'available'       => true,
            ]
        );

        $vehicle3 = Vehicle::firstOrCreate(
            ['registration_number' => 'C-11223-Rabat'],
            [
                'transporteur_id' => $transporteur2->id,
                'type'            => 'Camion plateau',
                'brand'           => 'Scania',
                'model'           => 'R450',
                'capacity'        => 20.00,
                'available'       => true,
            ]
        );

        $vehicle4 = Vehicle::firstOrCreate(
            ['registration_number' => 'D-44556-Rabat'],
            [
                'transporteur_id' => $transporteur2->id,
                'type'            => 'Camionnette',
                'brand'           => 'Peugeot',
                'model'           => 'Boxer',
                'capacity'        => 1.50,
                'available'       => true,
            ]
        );

        $vehicle5 = Vehicle::firstOrCreate(
            ['registration_number' => 'E-77889-Fes'],
            [
                'transporteur_id' => $transporteur3->id,
                'type'            => 'Semi-remorque',
                'brand'           => 'Volvo',
                'model'           => 'FH16',
                'capacity'        => 25.00,
                'available'       => false, // en mission
            ]
        );

        // ─── Demandes de transport ────────────────────────────────────────────
        // Demandes PENDING (disponibles pour les transporteurs)
        $req1 = TransportRequest::firstOrCreate(
            [
                'client_id'      => $client1->id,
                'departure_city' => 'Casablanca',
                'destination_city' => 'Marrakech',
            ],
            [
                'title'               => 'Transport de marchandises Casablanca - Marrakech',
                'departure_address'   => '15 Rue Mohamed V, Ain Sebaa',
                'destination_address' => 'Zone industrielle Sidi Ghanem',
                'pickup_at'           => now()->addDays(3),
                'goods_type'          => 'palette',
                'weight'              => 5.00,
                'volume'              => 12.00,
                'instructions'        => 'Marchandises fragiles, manipulation avec soin.',
                'estimated_budget'    => 2500.00,
                'status'              => 'pending',
            ]
        );

        $req2 = TransportRequest::firstOrCreate(
            [
                'client_id'        => $client2->id,
                'departure_city'   => 'Rabat',
                'destination_city' => 'Fès',
            ],
            [
                'title'               => 'Livraison produits alimentaires Rabat - Fès',
                'departure_address'   => 'Marché de gros, Hay Riad',
                'destination_address' => '42 Avenue Hassan II',
                'pickup_at'           => now()->addDays(5),
                'goods_type'          => 'frigorifique',
                'weight'              => 3.00,
                'volume'              => 8.00,
                'instructions'        => 'Produits frais, transport réfrigéré obligatoire.',
                'estimated_budget'    => 1800.00,
                'status'              => 'pending',
            ]
        );

        $req3 = TransportRequest::firstOrCreate(
            [
                'client_id'        => $client3->id,
                'departure_city'   => 'Casablanca',
                'destination_city' => 'Tanger',
            ],
            [
                'title'               => 'Déménagement matériel de bureau Casablanca - Tanger',
                'departure_address'   => 'Tour Anfa, Boulevard d\'Anfa',
                'destination_address' => 'Zone Franche Tanger Med',
                'pickup_at'           => now()->addDays(7),
                'goods_type'          => 'colis_volumineux',
                'weight'              => 2.00,
                'volume'              => 15.00,
                'instructions'        => 'Bureaux, chaises, équipements informatiques.',
                'estimated_budget'    => 3200.00,
                'status'              => 'pending',
            ]
        );

        // Demande ACCEPTED (avec offre acceptee + mission)
        $req4 = TransportRequest::firstOrCreate(
            [
                'client_id'        => $client1->id,
                'departure_city'   => 'Agadir',
                'destination_city' => 'Casablanca',
            ],
            [
                'title'               => 'Transport vrac - Agadir vers Casablanca',
                'departure_address'   => 'Port d\'Agadir',
                'destination_address' => 'Port de Casablanca',
                'pickup_at'           => now()->addDays(1),
                'goods_type'          => 'vrac',
                'weight'              => 18.00,
                'volume'              => 40.00,
                'instructions'        => null,
                'estimated_budget'    => 5000.00,
                'status'              => 'accepted',
            ]
        );

        // Demande COMPLETED
        $req5 = TransportRequest::firstOrCreate(
            [
                'client_id'        => $client2->id,
                'departure_city'   => 'Meknès',
                'destination_city' => 'Oujda',
            ],
            [
                'title'               => 'Livraison liquide Meknès - Oujda',
                'departure_address'   => 'Usine de mise en bouteille, Route de Fès',
                'destination_address' => 'Entrepôt central, Boulevard Derfoufi',
                'pickup_at'           => now()->subDays(10),
                'goods_type'          => 'liquide',
                'weight'              => 8.00,
                'volume'              => 20.00,
                'instructions'        => 'Citernes hermétiques requises.',
                'estimated_budget'    => 3500.00,
                'status'              => 'accepted',
            ]
        );

        // ─── Offres ───────────────────────────────────────────────────────────
        // Offres pending sur req1
        $offer1 = Offer::firstOrCreate(
            [
                'transport_request_id' => $req1->id,
                'transporteur_id'      => $transporteur1->id,
            ],
            [
                'vehicle_id'              => $vehicle1->id,
                'amount'                  => 2200.00,
                'message'                 => 'Bonjour, je dispose d\'un camion adapté pour ce type de transport.',
                'conditions'              => 'Paiement 50% à l\'enlèvement, 50% à la livraison.',
                'estimated_delivery_time' => '2 jours',
                'status'                  => 'pending',
            ]
        );

        $offer2 = Offer::firstOrCreate(
            [
                'transport_request_id' => $req1->id,
                'transporteur_id'      => $transporteur2->id,
            ],
            [
                'vehicle_id'              => $vehicle3->id,
                'amount'                  => 2400.00,
                'message'                 => 'Service fiable et rapide, 5 ans d\'expérience.',
                'conditions'              => 'Paiement à la livraison.',
                'estimated_delivery_time' => '1 jour et demi',
                'status'                  => 'pending',
            ]
        );

        // Offre accepted sur req4 + mission creee
        $offer3 = Offer::firstOrCreate(
            [
                'transport_request_id' => $req4->id,
                'transporteur_id'      => $transporteur3->id,
            ],
            [
                'vehicle_id'              => $vehicle5->id,
                'amount'                  => 4800.00,
                'message'                 => 'Semi-remorque de 25 tonnes, idéal pour ce volume.',
                'conditions'              => 'Paiement avant enlèvement.',
                'estimated_delivery_time' => '1 jour',
                'status'                  => 'accepted',
            ]
        );

        // Mission creee pour req4
        $mission1 = Mission::firstOrCreate(
            [
                'transport_request_id' => $req4->id,
                'offer_id'             => $offer3->id,
            ],
            [
                'client_id'       => $client1->id,
                'transporteur_id' => $transporteur3->id,
                'vehicle_id'      => $vehicle5->id,
                'status'          => 'in_delivery',
                'planned_at'      => now()->addDays(1),
                'delivered_at'    => null,
            ]
        );

        // Offre accepted sur req5 + mission terminee
        $offer4 = Offer::firstOrCreate(
            [
                'transport_request_id' => $req5->id,
                'transporteur_id'      => $transporteur1->id,
            ],
            [
                'vehicle_id'              => $vehicle1->id,
                'amount'                  => 3300.00,
                'message'                 => 'Camion frigorifique disponible pour ce trajet.',
                'conditions'              => 'Paiement à la livraison.',
                'estimated_delivery_time' => '3 jours',
                'status'                  => 'accepted',
            ]
        );

        // Mission livree pour req5
        $mission2 = Mission::firstOrCreate(
            [
                'transport_request_id' => $req5->id,
                'offer_id'             => $offer4->id,
            ],
            [
                'client_id'       => $client2->id,
                'transporteur_id' => $transporteur1->id,
                'vehicle_id'      => $vehicle1->id,
                'status'          => 'delivered',
                'planned_at'      => now()->subDays(10),
                'delivered_at'    => now()->subDays(7),
            ]
        );

        // ─── Evaluation ───────────────────────────────────────────────────────
        Review::firstOrCreate(
            [
                'mission_id' => $mission2->id,
                'client_id'  => $client2->id,
            ],
            [
                'transporteur_id' => $transporteur1->id,
                'rating'          => 5,
                'comment'         => 'Excellent service ! Livraison rapide et soignée. Je recommande vivement.',
            ]
        );

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
