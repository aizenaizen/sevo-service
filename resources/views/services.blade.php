@extends('layouts.app')

@section('title', $page->meta_title ?: 'Services — SEO, GEO & AEO | SEVO')
@section('description', $page->meta_description ?: 'Explore SEVO\'s three core services: SEO for traditional search rankings, GEO for AI answer engines, and AEO for answer boxes and voice search.')

@php
    $services = [
        [
            'id' => 'seo',
            'name' => 'SEO — Search Engine Optimization',
            'summary' => 'Rank higher on Google and Bing through technical health, content, and authority.',
            'color' => 'blue',
            'what' => 'Traditional search engine optimization: making sure Google and Bing can crawl, understand, and rank your site for the terms your customers actually search.',
            'deliverables' => [
                'Technical SEO audit (site speed, indexing, crawl errors, Core Web Vitals)',
                'Keyword research & content strategy',
                'On-page optimization (titles, meta, internal linking, schema markup)',
                'Authority building via digital PR & backlinks',
                'Monthly ranking & traffic reporting',
            ],
        ],
        [
            'id' => 'geo',
            'name' => 'GEO — Generative Engine Optimization',
            'summary' => 'Get cited and recommended by AI tools like ChatGPT, Gemini, and Perplexity.',
            'color' => 'emerald',
            'what' => 'Optimizing how your brand is represented in generative AI answers — structuring content, facts, and entities so language models cite you as a source and recommend you by name.',
            'deliverables' => [
                'AI visibility audit across major chat assistants',
                'Structured, citable content formatting',
                'Entity & knowledge-graph optimization',
                'Prompt-pattern research for your industry',
                'Ongoing AI mention tracking',
            ],
        ],
        [
            'id' => 'aeo',
            'name' => 'AEO — Answer Engine Optimization',
            'summary' => 'Win featured snippets, answer boxes, and voice assistant results.',
            'color' => 'blue',
            'what' => 'Formatting and structuring content specifically to win the "position zero" answer box, People Also Ask results, and voice assistant responses on devices like Alexa and Google Home.',
            'deliverables' => [
                'FAQ & how-to schema markup',
                'Answer-first content formatting',
                'Featured snippet & PAA targeting',
                'Voice search optimization',
                'Answer-box ranking tracking',
            ],
        ],
    ];
@endphp

@push('schema')
<script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'serviceType' => 'Search Everywhere Optimization',
        'provider' => ['@type' => 'Organization', 'name' => 'SEVO'],
        'areaServed' => 'Worldwide',
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name' => 'SEVO Services',
            'itemListElement' => collect($services)->map(fn ($s) => [
                '@type' => 'Offer',
                'itemOffered' => [
                    '@type' => 'Service',
                    'name' => $s['name'],
                    'description' => $s['summary'],
                ],
            ])->values(),
        ],
    ], JSON_UNESCAPED_SLASHES) !!}
</script>
@endpush

@section('content')
<section class="border-b border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-900/50">
    <div class="mx-auto max-w-4xl px-4 py-16 text-center sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl dark:text-white">{{ $page->h1 }}</h1>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-slate-600 dark:text-slate-400">
            Three disciplines, one goal: make sure your brand is found no matter how people search.
        </p>
    </div>
</section>

<section class="mx-auto max-w-5xl space-y-16 px-4 py-20 sm:px-6 lg:px-8">
    @foreach ($services as $service)
        <div id="{{ $service['id'] }}" class="scroll-mt-24 grid grid-cols-1 gap-8 lg:grid-cols-3">
            <div class="lg:col-span-1">
                <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold uppercase tracking-wide
                    {{ $service['color'] === 'blue'
                        ? 'bg-blue-100 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400'
                        : 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400' }}">
                    {{ strtoupper($service['id']) }}
                </span>
                <h2 class="mt-3 text-2xl font-bold text-slate-900 dark:text-white">{{ $service['name'] }}</h2>
                <p class="mt-3 text-slate-600 dark:text-slate-400">{{ $service['what'] }}</p>
                <a href="{{ route('quote') }}" class="mt-5 inline-flex rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 dark:bg-emerald-500 dark:hover:bg-emerald-400">
                    Get a quote for {{ strtoupper($service['id']) }}
                </a>
            </div>

            <div class="lg:col-span-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 dark:border-slate-800 dark:bg-slate-900">
                    <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">What's included</h3>
                    <ul class="mt-4 space-y-3">
                        @foreach ($service['deliverables'] as $item)
                            <li class="flex items-start gap-3 text-sm text-slate-700 dark:text-slate-300">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-emerald-600 dark:text-emerald-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                </svg>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</section>

<section class="border-t border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-900/50">
    <div class="mx-auto max-w-4xl px-4 py-16 text-center sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">Not sure which service you need?</h2>
        <p class="mx-auto mt-3 max-w-xl text-slate-600 dark:text-slate-400">
            Tell us about your goals and we'll recommend the right mix of SEO, GEO, and AEO.
        </p>
        <a href="{{ route('quote') }}" class="mt-6 inline-flex rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 dark:bg-emerald-500 dark:hover:bg-emerald-400">
            Get a free quote
        </a>
    </div>
</section>
@endsection
