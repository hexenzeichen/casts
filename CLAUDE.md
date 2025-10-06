# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Stack

Symfony 8.0 / PHP 8.4 application backed by MariaDB. Frontend uses Symfony AssetMapper (no bundler) with Stimulus JS controllers and Tailwind CSS via `symfonycasts/tailwind-bundle`.

## Environment

The app runs in Docker. The web container is `casts_web` and the DB container is `casts_db`.

```bash
docker-compose up -d
docker exec -it casts_web bash   # shell into the web container
```

The `DATABASE_URL` in `.env` points to `mariadb` (the Docker service hostname). To run console commands from the host, either exec into the container or override the DB URL.

## Common Commands

Run these inside the `casts_web` container (or prefix with `docker exec -it casts_web`):

```bash
# Database
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load       # resets DB and loads fixtures

# Tailwind CSS (compile once or watch)
php bin/console tailwind:build
php bin/console tailwind:build --watch

# AssetMapper
php bin/console importmap:install            # install JS vendor assets
php bin/console assets:install

# Code style (PHP CS Fixer with @Symfony ruleset)
vendor/bin/php-cs-fixer fix
vendor/bin/php-cs-fixer fix --dry-run

# Symfony console shortcuts
php bin/console debug:router
php bin/console debug:container
```

Custom CLI commands live in `src/Command/`:
- `app:ship:check-in <slug>` — checks in a starship
- `app:ship:remove` — removes a starship
- `app:ship:report` — reports on starships

## Architecture

### Domain model

The core domain is a starship repair shop. Key entities and their relationships:

- `Starship` — central entity with a Gedmo-generated `slug` and `Timestampable` `createdAt`/`updatedAt`. Has status (`StarshipStatusEnum`: WAITING / IN_PROGRESS / COMPLETED), `parts` (OneToMany → `StarshipPart`), and droids via a join entity.
- `StarshipDroid` — join table between `Starship` and `Droid` with an `assignedAt` timestamp.
- `StarshipPart` — parts associated with a ship; `StarshipPartRepository` exposes a reusable `createExpensiveCriteria()` Criteria object used by `Starship::getExpensiveParts()`.
- `User` — authenticated via email + password with optional 2FA (scheb/2fa-bundle).

### Security

`config/packages/security.yaml` defines a single `main` firewall using form_login with remember-me. `ROLE_ADMIN` implicitly grants `ROLE_COMMENT_ADMIN` and `ROLE_ALLOWED_TO_SWITCH`. The `/admin` path requires `ROLE_ADMIN`.

Authorization on individual ships is delegated to `ShipVoter` (`src/Security/Voter/ShipVoter.php`) — use `$this->denyAccessUnlessGranted('EDIT', $ship)` in controllers.

`CheckVerifiedUserSubscriber` blocks unverified users after login (email verification via `symfonycasts/verify-email-bundle`).

### Controllers

- `MainController` — homepage with paginated list of incomplete ships (Pagerfanta, 5 per page).
- `StarshipController` — single ship detail page, resolved by slug via `#[MapEntity]`.
- `StarshipApiController` — JSON REST endpoints at `/api/starships`.
- `PartController`, `AdminController`, `UserController` — parts management, admin panel, user settings.
- `SecurityController` / `RegistrationController` — login, registration, logout.

All controllers extend `BaseController` (which extends `AbstractController`).

### Test Fixtures

Fixtures use **Zenstruck Foundry** factories (`src/Factory/`). `AppFixtures` creates a fixed starship plus randomized sets (100 droids, 20 starships, 50 parts). `AppStory` (`src/Story/`) provides reusable story sets. `UserFixture` seeds test users.

### Frontend

Stimulus controllers are in `assets/controllers/`. The entry point is `assets/app.js`. Tailwind source is `assets/styles/app.css`; the compiled output goes to `var/tailwind/app.built.css`. Vendor JS is managed via `importmap.php` / `assets/vendor/`.
