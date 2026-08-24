# SEVO Service

## What this is

A website for a service business offering **SEO, GEO, and AEO** —
positioned together as **Search Everywhere Optimization (SEVO)**:

- **SEO** — Search Engine Optimization (traditional search, e.g. Google)
- **GEO** — Generative Engine Optimization (visibility in AI answers/chat tools like ChatGPT, Gemini, Perplexity)
- **AEO** — Answer Engine Optimization (visibility in answer boxes / featured snippets / voice assistants)

The pitch is that these three disciplines together cover every place a
customer might search — hence "Search Everywhere Optimization."

## Marketing channels

The site itself will be promoted via:
- Social media
- Google (organic + likely paid search)

This means the site should be built with its own SEO/GEO/AEO best practices
in mind (structured data, fast page loads, clean semantic HTML, shareable
OG/social meta tags) — the product is the proof of the pitch.

## Stack

**TALL stack** on **MySQL**, all pinned to latest at scaffold time (2026-08-24):
- **T**ailwind CSS v4 (CSS-first config, no `tailwind.config.js` — theme/tokens live in `resources/css/app.css`)
- **A**lpine.js (bundled inside Livewire's JS — no separate install)
- **L**aravel 13
- **L**ivewire 4
- MySQL (database `sevo_service`)

### PHP version note

WAMP's globally-selected PHP CLI is **8.1.31**, but Laravel 13 requires
PHP 8.2+. This project runs on **PHP 8.3.14**, also installed under WAMP at
`C:\wamp64\bin\php\php8.3.14\`. When running composer/artisan from the shell,
prefix `PATH` so PHP 8.3 wins, e.g.:

```
PATH="/c/wamp64/bin/php/php8.3.14:$PATH" composer install
"/c/wamp64/bin/php/php8.3.14/php.exe" artisan migrate
```

For Apache to actually serve this site (as opposed to `artisan serve`), the
WAMP vhost for this project must be set to use PHP 8.2+, not the global
default. No vhost has been configured yet — use `php artisan serve` for now.

### Livewire v4 conventions (this changed a lot from v3 — don't assume v3 docs apply)

- Components generated with `php artisan make:livewire Foo/Bar --mfc` land in
  `resources/views/components/foo/bar/bar.php` (+ `.blade.php`), **not**
  `app/Livewire`.
- Always pass `--emoji=false` (or rely on the project default, already set)
  when generating — otherwise Livewire prefixes the folder with a ⚡ emoji,
  which is bad for portability on some tooling/hosts.
- **Invocation is `<livewire:namespace.component-name />`, not
  `<x-namespace.component-name />`.** The `resources/views/components`
  directory is registered as both a Livewire component location *and* a
  Blade anonymous-component path, so `<x-...>` silently compiles as a plain
  Blade include — it renders, but skips the whole Livewire mount/hydrate
  cycle, so public properties on the component class (e.g. `$subscribed`)
  are undefined in the view. This bit us once already; always use the
  `<livewire:...>` tag for anything backed by a Livewire class.
- Alpine and Livewire's JS/CSS are auto-injected into any page that renders
  at least one Livewire component (`SupportAutoInjectedAssets`) — no
  `@livewireStyles`/`@livewireScripts` directives needed.

## Site structure

- `routes/web.php` — three routes: `home` (`/`), `services` (`/services`),
  `quote` (`/quote`)
- `resources/views/layouts/app.blade.php` — shared layout: header/nav, theme
  toggle, footer with embedded newsletter form, Organization JSON-LD,
  OG/Twitter meta tags. Pages `@extend` this and fill `title`, `description`,
  and `content` sections (`@push('schema')` for page-specific JSON-LD).
- `resources/views/home.blade.php` — hero, 3 service cards, process steps,
  FAQ (with FAQPage JSON-LD — an AEO example baked into the site itself),
  final CTA.
- `resources/views/services.blade.php` — detailed SEO/GEO/AEO breakdown
  (`#seo`, `#geo`, `#aeo` anchors) with Service/OfferCatalog JSON-LD.
- `resources/views/quote.blade.php` — wraps the quote request Livewire form.
- `resources/views/components/newsletter/signup-form/` — Livewire component,
  writes to `newsletter_subscribers` (email + name nullable, subscribed_at/
  unsubscribed_at for future unsubscribe flow). Embedded in the footer
  globally.
- `resources/views/components/quote/request-form/` — Livewire component,
  writes to `quote_requests` (name, email, phone, company, website_url,
  services as JSON array, budget_range, message, status default `new`).

## Theme

Light theme: white background, blue (`blue-600`) primary/CTAs, emerald green
for highlights/accents/checkmarks. Dark theme: slate-950/900 background, same
blue/emerald accent pairing shifted lighter (`blue-400`/`emerald-400`/`500`)
for contrast. Toggle is a plain button + vanilla JS (not Alpine) in the
header, using `localStorage.theme` + a blocking inline `<script>` in `<head>`
to avoid a flash of the wrong theme on load. Tailwind v4 dark mode is wired
via `@custom-variant dark (&:where(.dark, .dark *));` in `app.css` (class
strategy, not `prefers-color-scheme`, since there's a manual toggle).

## Conventions

- No admin/auth area yet — quote requests and newsletter subscribers just
  land in MySQL for now. Revisit if/when someone needs to review leads
  without going through Tinker/phpMyAdmin.
- OG share image is a placeholder SVG at `public/images/og-cover.svg` —
  replace with real brand artwork (ideally a PNG, since some crawlers
  render SVG OG images poorly) before launch.
