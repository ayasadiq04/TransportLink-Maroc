# TransportLink Maroc - AI Assistant Guidelines

## Project Overview
TransportLink Maroc is a logistics platform connecting shippers (clients) and professional carriers (transporteurs) in Morocco, supervised by administrators.

## Stack
- **Backend**: Laravel 11 (PHP 8.2+)
- **Frontend**: Blade Templates + Tailwind CSS + Alpine.js + Vite
- **Database**: MySQL 8.0 (Docker) / MySQL or SQLite (Local)
- **Authentication**: Laravel Breeze (Session-based)
- **Containerization**: Docker & Docker Compose
- **Testing**: PHPUnit

## Architecture
- **Pattern**: Standard MVC with Laravel conventions.
- **Roles & Permissions**:
  - `client`: Publishes transport requests, reviews received offers, accepts offers, tracks missions.
  - `transporteur`: Manages vehicle fleet, browses requests, submits offers, executes and updates missions.
  - `admin`: Platform supervision (users, requests, offers, missions, vehicles).
- **Domain Services**:
  - `OfferAcceptanceService`: Handles atomic transactions for offer acceptance, mission generation, and notifications.
  - `MissionStatusService`: Manages mission state transitions (`accepted` -> `in_delivery` -> `delivered`).
- **Authorization**: Policies (`TransportRequestPolicy`, `OfferPolicy`, `MissionPolicy`, `VehiclePolicy`) and `RoleMiddleware`.

## Development Environments
- **Dual Support**: The codebase supports both standalone Local development (Windows/macOS/Linux) and containerized Docker development seamlessly.
- **Local**: Runs directly on the host using PHP, Composer, and local MySQL (`DB_HOST=127.0.0.1:3306`).
- **Docker**: Runs isolated containers via Docker Compose (`DB_HOST=db:3306`), with database persistence through the `transportlink_mysql_data` volume.
- **Database Independence**: Local database and Docker database are two distinct environments. Never assume data is synced between them automatically.

## Core Rules for Assistants
1. **Preserve Business Logic**: Never alter workflow transitions, validation rules, or authorization logic without explicit user request.
2. **Environment Independence**: Never commit environment files (`.env`) or sensitive secrets to Git. Maintain compatibility for both Local and Docker setups.
3. **Database Integrity**: Never run destructive commands (such as `migrate:fresh` or `docker compose down -v`) on existing databases unless explicitly authorized. Always use migrations for schema updates.
4. **Code Quality**: Follow Laravel conventions (Form Requests for validation, Policies for authorization, Eloquent relationships).
