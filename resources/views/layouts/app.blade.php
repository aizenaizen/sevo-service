<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Set the theme before first paint to avoid a flash of the wrong theme. --}}
    <script>
        (function () {
            var stored = localStorage.getItem('theme');
            var isDark = stored ? stored === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
            document.documentElement.classList.toggle('dark', isDark);
        })();
    </script>

    <title>@yield('title', 'SEVO — Search Everywhere Optimization')</title>
    <meta name="description" content="@yield('description', 'SEVO helps brands get found everywhere people search — Google (SEO), AI answer engines like ChatGPT and Perplexity (GEO), and answer boxes & voice assistants (AEO).')">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph / social sharing --}}
    <meta property="og:site_name" content="SEVO">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'SEVO — Search Everywhere Optimization')">
    <meta property="og:description" content="@yield('description', 'SEO, GEO, and AEO under one roof — get found on Google, AI answer engines, and everywhere in between.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/og-cover.svg') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'SEVO — Search Everywhere Optimization')">
    <meta name="twitter:description" content="@yield('description', 'SEO, GEO, and AEO under one roof — get found on Google, AI answer engines, and everywhere in between.')">
    <meta name="twitter:image" content="{{ asset('images/og-cover.svg') }}">

    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22><text y=%2218%22 font-size=%2218%22>🔎</text></svg>">

    {{-- Organization structured data, present on every page --}}
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'SEVO',
            'url' => url('/'),
            'description' => 'SEVO offers SEO, GEO, and AEO services — Search Everywhere Optimization for brands that want to be found on Google, AI answer engines, and voice assistants alike.',
            'sameAs' => [],
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>

    @stack('schema')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100">

    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-lg focus:bg-blue-600 focus:px-4 focus:py-2 focus:text-white">
        Skip to content
    </a>

    <header class="sticky top-0 z-40 border-b border-slate-200 bg-white/80 backdrop-blur dark:border-slate-800 dark:bg-slate-950/80">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-lg font-bold tracking-tight text-slate-900 dark:text-white">
                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-600 text-white dark:bg-emerald-500">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </svg>
                </span>
                SEVO
            </a>

            <nav class="hidden items-center gap-8 text-sm font-medium text-slate-600 dark:text-slate-300 md:flex">
                <a href="{{ route('home') }}" class="hover:text-blue-600 dark:hover:text-emerald-400">Home</a>
                <a href="{{ route('services') }}" class="hover:text-blue-600 dark:hover:text-emerald-400">Services</a>
                <a href="{{ route('blog.index') }}" class="hover:text-blue-600 dark:hover:text-emerald-400">Blog</a>
                <a href="{{ route('home') }}#faq" class="hover:text-blue-600 dark:hover:text-emerald-400">FAQ</a>
            </nav>

            <div class="flex items-center gap-3">
                <button
                    type="button"
                    id="theme-toggle"
                    aria-label="Toggle dark mode"
                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-600 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800"
                >
                    <svg class="h-5 w-5 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="4"></circle>
                        <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"></path>
                    </svg>
                    <svg class="hidden h-5 w-5 dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                </button>

                <a href="{{ route('quote') }}" class="hidden rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 sm:inline-flex dark:bg-emerald-500 dark:hover:bg-emerald-400">
                    Get a quote
                </a>
            </div>
        </div>
    </header>

    <main id="main-content">
        @yield('content')
    </main>

    <footer class="border-t border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-900">
        <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-3 lg:gap-8">
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-2 text-lg font-bold text-slate-900 dark:text-white">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-600 text-white dark:bg-emerald-500">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="11" cy="11" r="7"></circle>
                                <path d="m21 21-4.3-4.3"></path>
                            </svg>
                        </span>
                        SEVO
                    </div>
                    <p class="mt-3 max-w-xs text-sm text-slate-600 dark:text-slate-400">
                        Search Everywhere Optimization — SEO, GEO &amp; AEO under one roof, so you're found on Google, AI answer engines, and everywhere in between.
                    </p>
                </div>

                <div class="lg:col-span-2">
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Get search insights in your inbox</h3>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">One email a month — no spam, unsubscribe anytime.</p>
                    <div class="mt-4 max-w-md">
                        <livewire:newsletter.signup-form />
                    </div>
                </div>
            </div>

            <div class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-slate-200 pt-6 text-sm text-slate-500 dark:border-slate-800 dark:text-slate-500 sm:flex-row">
                <p>&copy; {{ date('Y') }} SEVO. All rights reserved.</p>
                <div class="flex items-center gap-5">
                    <a href="{{ route('services') }}" class="hover:text-blue-600 dark:hover:text-emerald-400">Services</a>
                    <a href="{{ route('blog.index') }}" class="hover:text-blue-600 dark:hover:text-emerald-400">Blog</a>
                    <a href="{{ route('quote') }}" class="hover:text-blue-600 dark:hover:text-emerald-400">Get a quote</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('theme-toggle').addEventListener('click', function () {
            var isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    </script>
</body>
</html>
