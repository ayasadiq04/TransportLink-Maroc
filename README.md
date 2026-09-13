# 🚛 TransportLink Maroc

> **Plateforme de mise en relation entre expéditeurs et transporteurs professionnels au Maroc**

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com)
[![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?style=flat-square&logo=docker&logoColor=white)](https://docker.com)
[![License](https://img.shields.io/badge/Licence-MIT-green?style=flat-square)](LICENSE)

---

## 📌 À propos du projet

**TransportLink Maroc** est une application web full-stack développée avec **Laravel 11**, conçue comme projet académique (Fil Rouge). Elle permet la mise en relation directe entre :

- 👤 **Clients** (expéditeurs) : qui publient des demandes de transport de marchandises
- 🚛 **Transporteurs** : qui consultent les demandes et soumettent des offres commerciales
- 🛡️ **Administrateurs** : qui supervisent l'ensemble de la plateforme

Le cycle complet est géré : de la publication d'une demande jusqu'à la livraison confirmée, avec notifications en temps réel à chaque étape.

---

## 🏗️ Stack technique

| Couche | Technologie |
|--------|-------------|
| **Backend** | Laravel 11 (PHP 8.2+) |
| **Authentification** | Laravel Breeze (sessions) |
| **Base de données** | MySQL 8.0 (Docker) / SQLite (local) |
| **Frontend** | Blade Templates + Vanilla CSS |
| **Assets** | Vite + TailwindCSS |
| **Conteneurisation** | Docker + Docker Compose |
| **Tests** | PHPUnit 11 |
| **Notifications** | Laravel Notifications (DB) |

---

## 🗂️ Structure du projet

```
TransportLink-Maroc/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── TransportRequestController.php
│   │   │   ├── OfferController.php
│   │   │   ├── MissionController.php
│   │   │   ├── VehicleController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── NotificationController.php
│   │   │   └── ProfileController.php
│   │   └── Middleware/
│   │       ├── RoleMiddleware.php
│   │       └── ContentSecurityPolicy.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── TransportRequest.php
│   │   ├── Offer.php
│   │   ├── Mission.php
│   │   └── Vehicle.php
│   ├── Services/
│   │   ├── OfferAcceptanceService.php
│   │   └── MissionStatusService.php
│   ├── Policies/
│   │   ├── TransportRequestPolicy.php
│   │   ├── OfferPolicy.php
│   │   ├── MissionPolicy.php
│   │   └── VehiclePolicy.php
│   └── Notifications/
│       ├── NewTransportRequestNotification.php
│       ├── NewOfferNotification.php
│       ├── OfferAcceptedNotification.php
│       ├── OfferRejectedNotification.php
│       └── MissionStatusUpdatedNotification.php
├── database/
│   ├── migrations/         (13 migrations)
│   ├── seeders/
│   └── factories/
├── resources/views/
│   ├── welcome.blade.php
│   ├── layouts/
│   ├── admin/
│   ├── client/
│   ├── transporteur/
│   └── auth/
├── routes/
│   ├── web.php
│   └── auth.php
├── tests/Feature/          (10 fichiers de tests)
├── docker-compose.yml
└── Dockerfile
```

---

## ⚙️ Installation avec Docker (recommandé)

### Prérequis
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) installé et démarré
- Git

```bash
# 1. Cloner
git clone https://github.com/ayasadiq04/TransportLink-Maroc.git
cd TransportLink-Maroc

# 2. Environnement
cp .env.example .env

# 3. Lancer les conteneurs
docker compose up -d --build

# 4. Initialiser
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed   # optionnel

# 5. Assets
npm install && npm run build
```

Accéder à : **http://localhost:8000**

---

## 🚀 Installation locale (sans Docker)

```bash
composer install
npm install
cp .env.example .env
# Dans .env : DB_CONNECTION=sqlite
touch database/database.sqlite
php artisan key:generate
php artisan migrate --seed
npm run dev
php artisan serve
```

---

## 👥 Rôles et Fonctionnalités

### 🟦 Client (Expéditeur)

| Fonctionnalité | Description |
|----------------|-------------|
| Publier une demande | Titre, villes, type de marchandise, poids, budget, date |
| Gérer ses demandes | Lister, filtrer, modifier, supprimer |
| Consulter les offres | Voir et comparer toutes les offres reçues |
| Accepter / Rejeter | Accepter → création automatique d'une mission |
| Suivre les missions | Statut : En attente → Acceptée → En livraison → Livrée |
| Notifications | Alertes nouvelles offres et changements de statut |

### 🟧 Transporteur

| Fonctionnalité | Description |
|----------------|-------------|
| Dashboard | Offres soumises, missions actives, véhicules |
| Gérer sa flotte | CRUD véhicules (type, capacité, disponibilité) |
| Consulter les demandes | Demandes disponibles paginées |
| Soumettre une offre | Montant, véhicule, message, délai estimé |
| Gérer ses missions | Mise à jour statut : Acceptée → En livraison → Livrée |
| Notifications | Alerte acceptation / rejet d'offre |

### 🟥 Administrateur

| Fonctionnalité | Description |
|----------------|-------------|
| Tableau de bord | Statistiques globales de la plateforme |
| Gestion utilisateurs | Lister, consulter, activer/désactiver, supprimer |
| Supervision demandes | Vue complète avec protections métier |
| Supervision offres | Toutes les offres de la plateforme |
| Supervision missions | Historique et missions en cours |
| Supervision véhicules | Toute la flotte enregistrée |

---

## 🔄 Flux métier

```
[Client] Publie une demande
        │
        ▼
[Transporteurs] Notifiés → consultent les demandes disponibles
        │
        ▼
[Transporteur] Soumet une offre (montant + véhicule + conditions)
        │
        ▼
[Client] Notifié → compare et accepte une offre
        │
        ▼
        Mission créée automatiquement (DB::transaction)
        Autres offres → rejetées  |  Véhicule → indisponible
        │
        ▼
[Transporteur] pending → accepted → in_delivery → delivered
        │
        ▼
[Client] Notifié à chaque changement
        │
        ▼
Mission livrée → Demande "completed" → Véhicule libéré
```

---

## 🗄️ Schéma de base de données

| Table | Colonnes principales | Relations |
|-------|----------------------|-----------|
| `users` | id, name, email, role, phone, city, address | — |
| `transport_requests` | client_id, title, departure_city, destination_city, goods_type, weight, pickup_at, status | users |
| `vehicles` | transporteur_id, type, brand, capacity_tons, available | users |
| `offers` | transport_request_id, transporteur_id, vehicle_id, amount, status | users, transport_requests, vehicles |
| `missions` | offer_id, client_id, transporteur_id, vehicle_id, status, planned_at, delivered_at | tous |
| `notifications` | notifiable_id, type, data (JSON), read_at | users |

**Statuts :**
- `transport_requests.status` : `pending` → `accepted` → `completed` / `cancelled`
- `offers.status` : `pending` → `accepted` / `rejected`
- `missions.status` : `pending` → `accepted` → `in_delivery` → `delivered` / `cancelled`

---

## 🧪 Tests

```bash
docker compose exec app php artisan test
```

**25 tests — 61 assertions — 100% pass**

| Fichier | Ce qui est testé |
|---------|-----------------|
| `WorkflowIntegrationTest` | Flux complet de bout en bout |
| `WorkflowTest` | Scénarios métier isolés |
| `NotificationTest` | Tous les déclenchements de notifications |
| `AuthorizationTest` | Politiques d'accès (Policies) |
| `RoleAccessTest` | Middleware RoleMiddleware |
| `DeletionProtectionTest` | Protections avant suppression |
| `ContentSecurityPolicyTest` | En-têtes CSP |
| `ProfileTest` | Modification du profil |
| `ViewRenderTest` | Rendu des vues principales |

---

## 🔐 Sécurité

- **CSRF** : protection automatique Laravel sur tous les formulaires
- **Middleware de rôle** : `role:client`, `role:transporteur`, `role:admin`
- **Laravel Policies** : autorisation fine par ressource et action
- **CSP** : en-têtes `Content-Security-Policy` sur toutes les réponses
- **Transactions DB** : `OfferAcceptanceService` garantit l'intégrité atomique
- **Protections métier** : suppression bloquée si missions actives présentes

---

## 📬 Notifications (5 événements)

| Événement | Destinataire |
|-----------|-------------|
| Nouvelle demande publiée | Tous les transporteurs |
| Nouvelle offre reçue | Le client concerné |
| Offre acceptée | Le transporteur gagnant |
| Offre rejetée | Le transporteur rejeté |
| Statut de mission mis à jour | Le client |

---

## 🐳 Commandes Docker utiles

```bash
docker compose up -d              # Démarrer en arrière-plan
docker compose down               # Arrêter
docker compose exec app sh        # Shell dans le conteneur
docker compose logs -f            # Logs en temps réel
docker compose exec app php artisan test  # Lancer les tests
```

---

## 📧 Contact

**Développeuse** : Aya Sadiq
**Email** : [ayasadiq@gmail.com](mailto:ayasadiq@gmail.com)
**Téléphone** : +212 700 070 007
**Localisation** : fkih ben saleh, Maroc

---

## 📄 Licence

Projet académique Fil Rouge — distribué sous licence [MIT](LICENSE).

---

*TransportLink Maroc — Connecter les expéditeurs aux transporteurs de confiance à travers le Royaume 🇲🇦*
