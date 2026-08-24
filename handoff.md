# Handoff Notes

## Project

**SEVO Service** — a website offering SEO, GEO, and AEO services, marketed
together as "Search Everywhere Optimization."

- **SEO** — Search Engine Optimization
- **GEO** — Generative Engine Optimization (AI chat/generative search tools)
- **AEO** — Answer Engine Optimization (answer boxes, voice, snippets)

## Marketing plan

The site will be marketed via:
- Social media
- Google

## Stack

**TALL stack** (Tailwind, Alpine.js, Laravel, Livewire) on **MySQL**.

Driven by the need for a newsletter (subscriber storage/mail) and quotation
pages (DB-backed quote requests) — both need server-side app logic, not a
static site.

## Status as of 2026-08-24

Site is built and working end-to-end, tested in-browser (theme toggle,
newsletter signup, and quote form all verified to actually write to MySQL).
A CMS was added the same day (see below) and also verified in-browser.

- Laravel 13 + Livewire 4 + Tailwind v4, all latest as of scaffold time.
- Runs on **PHP 8.3.14** (WAMP's global default is still 8.1.31, which is too
  old for Laravel 13's 8.2+ requirement) — see the PHP version note in
  `CLAUDE.md` for how to run composer/artisan commands correctly.
- Pages: home (`/`), services (`/services`, with `#seo`/`#geo`/`#aeo`
  anchors), quote request (`/quote`), blog (`/blog`, `/blog/{slug}`), plus
  any custom CMS pages at `/{slug}`.
- Newsletter signup (footer, every page) and quote request form are Livewire
  components backed by `newsletter_subscribers` and `quote_requests` MySQL
  tables.
- Light/dark theme toggle in the header (blue/white + emerald green accents
  in light mode), persisted to `localStorage`, no flash-of-wrong-theme.
- On-page SEO/GEO/AEO practiced on the site itself: Organization JSON-LD
  sitewide, Service/OfferCatalog JSON-LD on the services page, FAQPage
  JSON-LD on the home page FAQ section, Article JSON-LD on blog posts,
  OG/Twitter meta tags (placeholder SVG share image — swap for real artwork
  before launch).

### CMS (added 2026-08-24)

A password-gated admin area at `/admin` (see `ADMIN_PASSWORD` in `.env`,
middleware `EnsureAdminAuthenticated` / alias `admin.auth`) provides:

- **Pages** (`/admin/pages`) — edit H1 + meta title/description for the
  three "system" pages (home/services/quote, `pages` table `type=system`,
  matched by `route_name`), and full CRUD for "custom" pages (`type=custom`,
  matched by `slug`) served through a catch-all route
  `Route::get('/{page:slug}', ...)` that's deliberately last in
  `routes/web.php` so it never shadows the named routes above it.
- **Blog posts** (`/admin/posts`) — title/slug/excerpt/body/featured image
  (stored via `Storage::disk('public')`, needs `php artisan storage:link`)/
  meta fields/categories/draft-publish status. Public at `/blog`.
- **Categories** (`/admin/categories`) — simple many-to-many taxonomy via
  `category_post` pivot.

All three admin screens are Livewire single-file components (`--mfc`)
embedded in plain Blade pages via `<livewire:admin.pages.system-pages />`
etc. — routed to via `Route::view()` rather than routing directly to the
Livewire class, since Livewire v4 MFCs are anonymous classes and this
project's existing convention (quote/newsletter forms) always embeds
Livewire via the `<livewire:>` tag rather than direct-to-component routing.

The original home-page H1 had a styled inline `<span>` around the word
"everywhere" (different color highlight) — making it CMS-editable meant
flattening it to plain text, so that highlight is gone unless someone
reintroduces it as a one-off (not worth it for a single word on one page).

Installed `@tailwindcss/typography` (`@plugin '@tailwindcss/typography';`
in `resources/css/app.css`) to style the raw HTML body content that custom
pages and blog posts render via `{!! $page->body !!}` / `{!! $post->body !!}`
— there was no prose styling in the project before this.

Tested in-browser end-to-end (login, edit+save a system H1, create+view a
custom page, create a category, create+view a published blog post with
category), then cleaned up the test data via `artisan tinker` afterward —
DB should have no leftover test pages/posts/categories from that session.

### Gotchas hit while building this

- WAMP's MySQL root password is **`root`**, not empty (tried empty first,
  got `Access denied`). Already set in `.env`/`.env.example`.
- Livewire v4 components must be invoked as `<livewire:name />`, never
  `<x-name />` — using `<x->` silently renders the template without
  mounting the backing class, so public properties come back undefined.
  Full detail in `CLAUDE.md` under "Livewire v4 conventions." Cost real
  debugging time this session — don't relearn it.
- Test data (one quote request, one newsletter subscriber) created while
  verifying the forms in-browser was truncated from both tables afterward —
  DB should be empty of leads right now.

### Not done yet / open items

- No WAMP vhost configured — currently only reachable via
  `php artisan serve`. Need a vhost pointed at `public/` with PHP 8.2+
  selected for it.
- No admin view of quote/newsletter leads — the CMS added 2026-08-24 covers
  pages/posts/categories only; `quote_requests` and `newsletter_subscribers`
  are still only visible via MySQL/Tinker.
- `ADMIN_PASSWORD` in `.env` is still the local dev placeholder — must be
  changed to something real before deploying, since it's the only thing
  gating `/admin`.
- No mail sending wired up (`MAIL_MAILER=log` — quote/newsletter
  confirmations aren't emailed anywhere yet).
- OG share image (`public/images/og-cover.svg`) is a placeholder — needs
  real brand artwork.
- No real branding/logo — header currently uses a generic search icon.
- Repo has a git remote (`origin` → `aizenaizen/sevo-service`) with a single
  "first commit" containing just the stock Laravel README — the actual app
  code hasn't been committed/pushed yet.
