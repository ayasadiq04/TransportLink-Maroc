 # TransportLink Maroc

Plateforme de mise en relation entre **expéditeurs** et **transporteurs** au Maroc : les clients publient leurs demandes de transport, les transporteurs consultent les demandes disponibles et soumettent leurs offres, puis les deux parties suivent la mission jusqu'à la livraison.

## Problème résolu

En l'absence de place de marché structurée, trouver un transporteur (ou une cargaison) au Maroc repose sur le bouche-à-oreille et des moyens informels : appels multiples, prix opaques, aucune traçabilité. TransportLink centralise l'offre et la demande :

- les clients trouvent rapidement un transporteur pour une marchandise donnée ;
- les transporteurs remplissent leur flotte en trouvant des trajets rentables ;
- chaque mission dispose d'un suivi d'états clair de la demande jusqu'à la livraison.

## Fonctionnalités principales

- **Demandes de transport** : création, modification, suppression et suivi par le client (départ, arrivée, marchandise, poids, budget estimé, date d'enlèvement).
- **Demandes disponibles** : liste simple des demandes en attente accessible aux transporteurs, avec pagination.
- **Offres** : le transporteur propose un prix, un véhicule et des conditions ; le client accepte ou rejette (l'acceptation génère automatiquement la mission et refuse les autres offres).
- **Missions** : suivi des états `in_delivery` → `delivered`, complétion automatique de la demande.
- **Véhicules** : gestion du parc transporteur (type, marque, modèle, capacité, disponibilité).
- **Administration** : tableau de bord, gestion des utilisateurs, demandes, offres, missions et véhicules.
- **Espace personnel** : profil éditable, mot de passe, suppression de compte.
- **Notifications** : notifications en base de données (cloche + compteur, lu/non-lu) lors de la création d'une demande, d'une offre, de l'acceptation/refus et des changements de statut de mission.
- **Notifications email** : envois optionnels depuis le canal `database` lorsque le SMTP est réellement configuré.
- **Sécurité** : middleware de rôle, policies d'autorisation, en-tête Content-Security-Policy global.

## Rôles

| Rôle | Accès |
| --- | --- |
| **Admin** | Tableau de bord global, gestion des utilisateurs, demandes, offres, missions et véhicules. |
| **Client** | Gère ses demandes de transport, reçoit les offres, accepte/rejette, suit ses missions. |
| **Transporteur** | Gère ses véhicules, consulte les demandes disponibles, soumet des offres et met à jour le statut de ses missions. |

## Stack technique

- **Laravel 11** (PHP 8.2+, image Docker PHP 8.4)
- **PHP**
- **MySQL 8.0**
- **Blade** (templating serveur)
- **Tailwind CSS**
- **Alpine.js**
- **Vite** (build front)
- **Docker** / Docker Compose

## Architecture générale

Application **MVC serveur-rendue** (Blade) :

- contrôles d'accès par rôle via `RoleMiddleware` et par entité via les **policies** ;
- routage séparé : `routes/web.php` (application web) et `routes/auth.php` (authentification Breeze) ;
- vues organisées par rôle : `client/`, `transporteur/`, `admin/`, `auth/`, `profile/` ;
- validation des entrées dans `app/Http/Requests` ;
- middleware global **Content-Security-Policy** ;
- modèle de données : `users`, `vehicles`, `transport_requests`, `offers`, `missions`, `notifications`.

## Installation avec Docker

Prérequis : Docker et Docker Compose.

```sh
# 1. Copier la configuration d'environnement
cp .env.example .env

# 2. Démarrer les conteneurs (app PHP + base MySQL)
docker compose up -d

# 3. Installer les dépendances PHP et JS
docker compose exec app composer install
docker compose exec app npm install

# 4. Générer la clé applicative
docker compose exec app php artisan key:generate

# 5. Créer les tables
docker compose exec app php artisan migrate

# 6. Remplir la base avec les données de démonstration
docker compose exec app php artisan db:seed

# 7. Compiler les assets front
docker compose exec app npm run build

# 8. Accéder à l'application
# http://localhost:8000
```

## Configuration .env

Le fichier `.env` (non versionné) contient la configuration de l'application. Variables clés :

```env
APP_NAME="TransportLink Maroc"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db          # "db" (réseau Docker) ou 127.0.0.1 (local)
DB_PORT=3306
DB_DATABASE=transportlink
DB_USERNAME=transportlink
DB_PASSWORD=transportlink_password
```

Les valeurs de la base MySQL du Docker Compose sont définies dans `docker-compose.yml` (base `transportlink`, utilisateur `transportlink`, mot de passe `transportlink_password`, port hôte `3307`).

## Commandes importantes

```sh
docker compose up -d                                   # Démarrer app + base
docker compose exec app php artisan migrate            # Créer/migrer les tables
docker compose exec app php artisan db:seed            # Données de démonstration
docker compose exec app php artisan migrate:fresh --seed  # Repartir de zéro + seed
docker compose exec app php artisan test               # Lancer les tests
docker compose exec app npm install                    # Dépendances front
docker compose exec app npm run build                  # Compiler les assets Vite
```

## Comptes de démonstration

Créés par le seeder (`database/seeders/DatabaseSeeder.php`), mot de passe commun : `password`

| Rôle | Email |
| --- | --- |
| Admin | `admin@transportlink.ma` |
| Client 1 | `client1@transportlink.ma` |
| Client 2 | `client2@transportlink.ma` |
| Client 3 | `client3@transportlink.ma` |
| Transporteur 1 | `transporteur1@transportlink.ma` |
| Transporteur 2 | `transporteur2@transportlink.ma` |
| Transporteur 3 | `transporteur3@transportlink.ma` |

## Structure principale des dossiers

```
app/
├── Http/
│   ├── Controllers/      # Contrôleurs web
│   ├── Middleware/       # RoleMiddleware, ContentSecurityPolicy
│   └── Requests/         # Validation des formulaires
├── Models/               # User, TransportRequest, Offer, Mission, Vehicle
├── Notifications/        # Notifications métier (base de données, email optionnel)
└── Policies/             # Autorisations par entité

database/
├── factories/            # Factories Eloquent (tests, seeding)
├── migrations/           # Schéma de la base
└── seeders/              # Données de démonstration

resources/views/          # Vues Blade
├── admin/                # Interface admin
├── client/               # Interface client
├── transporteur/         # Interface transporteur
├── auth/ profile/ layouts/ components/

routes/
├── web.php               # Routes de l'application web
└── auth.php              # Routes d'authentification

tests/                    # Tests Feature et Unit
```

## Tests

La suite de tests (`tests/Feature/`) couvre : authentification et vérification d'email, rôles et accès, workflows complets (demande → offre → mission → livraison), protections de suppression, rendu des pages, notifications et en-tête CSP (aucun script inline).

```sh
docker compose exec app php artisan test
```

## Développement local

**Avec Docker** : démarrer les conteneurs puis lancer le serveur Vite :

```sh
docker compose up -d
docker compose exec app npm run dev
```

L'application est servie sur `http://localhost:8000` (serveur `php artisan serve` du conteneur) et le hot-reload Vite sur `http://localhost:5173`.

**Sans Docker** : installer PHP 8.2+, Composer et Node ; copier `.env.example` en `.env`, paramétrer MySQL (`DB_HOST=127.0.0.1`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) puis :

```sh
composer install
npm install
php artisan key:generate
php artisan migrate --seed
npm run dev
```

---

Sous réserve des mentions contraires dans le code, toutes les informations de ce document reflètent l'état réel du projet à la date de sa dernière mise à jour.