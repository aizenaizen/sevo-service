@extends('layouts.app')

@section('title', $page->meta_title ?: 'Get a Free Quote | SEVO')
@section('description', $page->meta_description ?: 'Tell us about your business and goals — SEVO will put together a tailored SEO, GEO & AEO quote within one business day.')

@section('content')
<section class="border-b border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-900/50">
    <div class="mx-auto max-w-3xl px-4 py-16 text-center sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl dark:text-white">{{ $page->h1 }}</h1>
        <p class="mx-auto mt-4 max-w-xl text-lg text-slate-600 dark:text-slate-400">
            Tell us a bit about your business and goals. We'll come back to you with a tailored SEO, GEO &amp; AEO plan.
        </p>
    </div>
</section>

<section class="mx-auto max-w-3xl px-4 py-16 sm:px-6 lg:px-8">
    <livewire:quote.request-form />
</section>
@endsection
