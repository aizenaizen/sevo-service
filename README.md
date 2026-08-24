# SEVO Service

A website for a service business offering **SEO, GEO, and AEO** — positioned
together as **Search Everywhere Optimization (SEVO)**. Built on the TALL
stack (Tailwind CSS, Alpine.js, Laravel, Livewire) with MySQL, with a
password-gated CMS for editing page headings, managing custom pages, and
running a blog.

See `CLAUDE.md` for the full architectural rundown (routes, view structure,
Livewire conventions, theme system).

## Requirements

- **PHP 8.3+** with these extensions (standard on most installs, but worth
  checking): `openssl`, `pdo_mysql`, `mbstring`, `tokenizer`, `xml`, `ctype`,
  `json`, `bcmath`, `fileinfo`, `curl`.
- **Composer 2+**
- **Node.js 18+** and npm (for Tailwind v4 / Vite)
- **MySQL 8+** (or MariaDB equivalent)

### WAMP-specific note

WAMP's globally-selected PHP CLI may be older than 8.2 (Laravel 13's
minimum). This project was built and run against PHP 8.3.14 installed
separately under WAMP at `C:\wamp64\bin\php\php8.3.14\`. If your global
`php` resolves to an older version, prefix `PATH` when running
composer/artisan/npm commands from the shell, e.g.:

```bash
PATH="/c/wamp64/bin/php/php8.3.14:$PATH" composer install
PATH="/c/wamp64/bin/php/php8.3.14:$PATH" php artisan migrate
```

For Apache/WAMP to serve the site directly (instead of `artisan serve`),
the vhost for this project must be configured to use PHP 8.2+, not
whatever WAMP's global default is.

## Setup

```bash
composer install
npm install

cp .env.example .env
php artisan key:generate
```

Edit `.env` and set:

- `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` — your MySQL credentials
  (database `sevo_service` is expected to already exist, or create it first)
- `ADMIN_PASSWORD` — the password used to log into the CMS at `/admin/login`
  (defaults to a placeholder — **change this before deploying**)

Then run migrations and link storage (needed for blog featured images to be
publicly served):

```bash
php artisan migrate
php artisan storage:link
```

Build front-end assets:

```bash
npm run build
```

## Running locally

```bash
php artisan serve
```

Or, for asset hot-reloading while developing:

```bash
composer dev
```

Visit `http://localhost:8000`. The CMS admin area is at
`http://localhost:8000/admin/login`.

## What's in the CMS

- **Pages** (`/admin/pages`) — edit the H1 heading and meta title/description
  for the Home, Services, and Quote pages, and create/edit/delete fully
  custom pages served at `/{slug}`.
- **Blog posts** (`/admin/posts`) — create/edit/delete blog posts with a
  featured image, excerpt, HTML body, categories, and a draft/published
  workflow. Published posts appear at `/blog`.
- **Categories** (`/admin/categories`) — simple taxonomy for grouping blog
  posts.

There's no per-user login — a single shared password (`ADMIN_PASSWORD` in
`.env`) gates the whole `/admin` area. See CLAUDE.md's "Conventions" section
for why, and revisit if multiple admins are ever needed.
