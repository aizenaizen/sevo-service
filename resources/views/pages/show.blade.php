@extends('layouts.app')

@section('title', $page->meta_title ?: $page->h1.' | SEVO')
@section('description', $page->meta_description ?: '')

@section('content')
<section class="mx-auto max-w-3xl px-4 py-16 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl dark:text-white">{{ $page->h1 }}</h1>

    <div class="prose prose-slate mt-8 max-w-none dark:prose-invert">
        {!! $page->body !!}
    </div>
</section>
@endsection
