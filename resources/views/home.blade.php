@extends('layouts.app')

@section('title', $page->meta_title ?: 'SEVO — Search Everywhere Optimization (SEO, GEO & AEO)')
@section('description', $page->meta_description ?: 'One team, every search surface. SEVO combines SEO, GEO, and AEO to get your brand found on Google, AI answer engines like ChatGPT, and voice/answer-box results.')

@php
    $faqs = [
        [
            'q' => 'What is Search Everywhere Optimization (SEVO)?',
            'a' => 'SEVO is the combination of SEO, GEO, and AEO — optimizing your brand for traditional search engines, generative AI answer engines, and answer-box/voice results, so you show up wherever someone is actually searching.',
        ],
        [
            'q' => 'What is the difference between SEO, GEO, and AEO?',
            'a' => 'SEO (Search Engine Optimization) targets rankings on engines like Google. GEO (Generative Engine Optimization) targets visibility inside AI answers from tools like ChatGPT, Gemini, and Perplexity. AEO (Answer Engine Optimization) targets featured snippets, answer boxes, and voice assistant responses.',
        ],
        [
            'q' => 'Do I need GEO if I already do SEO?',
            'a' => 'Yes — a growing share of searches now happen inside AI chat tools rather than a traditional search results page. Ranking well on Google no longer guarantees your brand is mentioned when someone asks an AI assistant the same question.',
        ],
        [
            'q' => 'How long does it take to see results?',
            'a' => 'Most clients see early movement — indexing, technical fixes, initial AI answer mentions — within 4-6 weeks, with compounding gains over 3-6 months as content and authority build.',
        ],
    ];
@endphp

@push('schema')
<script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => collect($faqs)->map(fn ($faq) => [
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $faq['a'],
            ],
        ])->values(),
    ], JSON_UNESCAPED_SLASHES) !!}
</script>
@endpush

@section('content')
<section class="relative overflow-hidden">
    <div class="pointer-events-none absolute inset-0 -z-10">
        <div class="absolute -top-24 right-0 h-96 w-96 rounded-full bg-emerald-200/40 blur-3xl dark:bg-emerald-500/10"></div>
        <div class="absolute -left-24 top-40 h-72 w-72 rounded-full bg-blue-200/50 blur-3xl dark:bg-blue-500/10"></div>
    </div>

    <div class="mx-auto max-w-6xl px-4 pb-20 pt-16 sm:px-6 sm:pb-28 sm:pt-24 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-1.5 text-xs font-semibold uppercase tracking-wide text-blue-700 dark:border-emerald-500/30 dark:bg-emerald-500/10 dark:text-emerald-400">
                SEO &middot; GEO &middot; AEO
            </span>

            <h1 class="mt-6 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl dark:text-white">
                {{ $page->h1 }}
            </h1>

            <p class="mx-auto mt-6 max-w-2xl text-lg text-slate-600 dark:text-slate-300">
                Search doesn't live on one page anymore. SEVO optimizes your brand for Google
                (<strong class="font-semibold text-slate-800 dark:text-slate-100">SEO</strong>), AI answer
                engines like ChatGPT and Perplexity (<strong class="font-semibold text-slate-800 dark:text-slate-100">GEO</strong>),
                and answer boxes &amp; voice assistants
                (<strong class="font-semibold text-slate-800 dark:text-slate-100">AEO</strong>) — one strategy,
                every surface.
            </p>

            <div class="mt-10 flex flex-col items-center justify-center gap-3 sm:flex-row">
                <a href="{{ route('quote') }}" class="w-full rounded-lg bg-blue-600 px-6 py-3 text-center text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 sm:w-auto dark:bg-emerald-500 dark:hover:bg-emerald-400">
                    Get a free quote
                </a>
                <a href="{{ route('services') }}" class="w-full rounded-lg border border-slate-300 px-6 py-3 text-center text-sm font-semibold text-slate-700 transition hover:border-blue-400 hover:text-blue-700 sm:w-auto dark:border-slate-700 dark:text-slate-200 dark:hover:border-emerald-500 dark:hover:text-emerald-400">
                    Explore our services
                </a>
            </div>
        </div>
    </div>
</section>

<section class="border-y border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-900/50">
    <div class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">Three disciplines. One search strategy.</h2>
            <p class="mt-4 text-slate-600 dark:text-slate-400">Each service stands alone — together they cover the full search landscape.</p>
        </div>

        <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-3">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><path d="m21 21-4.3-4.3"></path></svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-slate-900 dark:text-white">SEO</h3>
                <p class="mt-1 text-sm font-medium text-blue-600 dark:text-emerald-400">Search Engine Optimization</p>
                <p class="mt-3 text-sm text-slate-600 dark:text-slate-400">Technical fixes, content, and links that move you up Google &amp; Bing results pages.</p>
                <a href="{{ route('services') }}#seo" class="mt-4 inline-block text-sm font-semibold text-blue-600 hover:underline dark:text-emerald-400">Learn more →</a>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2a7 7 0 0 0-7 7c0 3 2 4 2 7h10c0-3 2-4 2-7a7 7 0 0 0-7-7Z"></path><path d="M9 21h6"></path><path d="M10 17h4"></path></svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-slate-900 dark:text-white">GEO</h3>
                <p class="mt-1 text-sm font-medium text-emerald-600 dark:text-emerald-400">Generative Engine Optimization</p>
                <p class="mt-3 text-sm text-slate-600 dark:text-slate-400">Structuring your content so AI tools like ChatGPT and Gemini cite and recommend you.</p>
                <a href="{{ route('services') }}#geo" class="mt-4 inline-block text-sm font-semibold text-blue-600 hover:underline dark:text-emerald-400">Learn more →</a>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 18v3"></path><path d="M8 21h8"></path><rect x="4" y="3" width="16" height="12" rx="2"></rect></svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-slate-900 dark:text-white">AEO</h3>
                <p class="mt-1 text-sm font-medium text-blue-600 dark:text-emerald-400">Answer Engine Optimization</p>
                <p class="mt-3 text-sm text-slate-600 dark:text-slate-400">Winning featured snippets, answer boxes, and voice assistant results.</p>
                <a href="{{ route('services') }}#aeo" class="mt-4 inline-block text-sm font-semibold text-blue-600 hover:underline dark:text-emerald-400">Learn more →</a>
            </div>
        </div>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">How we work</h2>
        <p class="mt-4 text-slate-600 dark:text-slate-400">A simple, transparent process from first audit to ongoing reporting.</p>
    </div>

    <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ([
            ['n' => '01', 'title' => 'Audit', 'body' => 'We assess your current SEO, GEO, and AEO visibility across search and AI surfaces.'],
            ['n' => '02', 'title' => 'Strategy', 'body' => 'A prioritized roadmap built around your market, budget, and goals.'],
            ['n' => '03', 'title' => 'Execute', 'body' => 'Technical, content, and structured-data work rolled out on a set cadence.'],
            ['n' => '04', 'title' => 'Report', 'body' => 'Clear monthly reporting on rankings, AI mentions, and traffic impact.'],
        ] as $step)
            <div class="rounded-2xl border border-slate-200 p-6 dark:border-slate-800">
                <span class="text-sm font-bold text-blue-600 dark:text-emerald-400">{{ $step['n'] }}</span>
                <h3 class="mt-2 text-base font-semibold text-slate-900 dark:text-white">{{ $step['title'] }}</h3>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">{{ $step['body'] }}</p>
            </div>
        @endforeach
    </div>
</section>

<section id="faq" class="border-t border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-900/50">
    <div class="mx-auto max-w-3xl px-4 py-20 sm:px-6 lg:px-8">
        <h2 class="text-center text-3xl font-bold tracking-tight text-slate-900 dark:text-white">Frequently asked questions</h2>

        <dl class="mt-10 space-y-6">
            @foreach ($faqs as $faq)
                <div class="rounded-2xl border border-slate-200 bg-white p-6 dark:border-slate-800 dark:bg-slate-900">
                    <dt class="text-base font-semibold text-slate-900 dark:text-white">{{ $faq['q'] }}</dt>
                    <dd class="mt-2 text-sm text-slate-600 dark:text-slate-400">{{ $faq['a'] }}</dd>
                </div>
            @endforeach
        </dl>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8">
    <div class="rounded-3xl bg-blue-600 px-8 py-14 text-center shadow-lg dark:bg-emerald-600 sm:px-16">
        <h2 class="text-3xl font-bold tracking-tight text-white">Ready to be found everywhere?</h2>
        <p class="mx-auto mt-3 max-w-xl text-blue-100 dark:text-emerald-50">
            Tell us about your business and we'll put together a tailored SEO, GEO &amp; AEO quote.
        </p>
        <a href="{{ route('quote') }}" class="mt-8 inline-flex rounded-lg bg-white px-6 py-3 text-sm font-semibold text-blue-700 shadow-sm transition hover:bg-blue-50 dark:text-emerald-700 dark:hover:bg-emerald-50">
            Get a free quote
        </a>
    </div>
</section>
@endsection
