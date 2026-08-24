@extends('layouts.app')

@section('title', $post->meta_title ?: $post->title.' | SEVO Blog')
@section('description', $post->meta_description ?: $post->excerpt ?: '')

@push('schema')
<script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $post->title,
        'description' => $post->meta_description ?: $post->excerpt,
        'image' => $post->featured_image ? asset('storage/'.$post->featured_image) : asset('images/og-cover.svg'),
        'datePublished' => optional($post->published_at)->toIso8601String(),
        'dateModified' => $post->updated_at->toIso8601String(),
        'author' => ['@type' => 'Organization', 'name' => 'SEVO'],
    ], JSON_UNESCAPED_SLASHES) !!}
</script>
@endpush

@section('content')
<article class="mx-auto max-w-3xl px-4 py-16 sm:px-6 lg:px-8">
    <a href="{{ route('blog.index') }}" class="text-sm font-medium text-blue-600 hover:underline dark:text-emerald-400">&larr; Back to blog</a>

    @if ($post->categories->isNotEmpty())
        <div class="mt-6 flex flex-wrap gap-2">
            @foreach ($post->categories as $category)
                <span class="rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-semibold text-blue-700 dark:bg-emerald-500/10 dark:text-emerald-400">{{ $category->name }}</span>
            @endforeach
        </div>
    @endif

    <h1 class="mt-4 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl dark:text-white">{{ $post->title }}</h1>
    <p class="mt-4 text-sm text-slate-400">{{ $post->published_at?->format('j F Y') }}</p>

    @if ($post->featured_image)
        <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" class="mt-8 w-full rounded-2xl border border-slate-200 object-cover dark:border-slate-800">
    @endif

    <div class="prose prose-slate mt-8 max-w-none dark:prose-invert">
        {!! $post->body !!}
    </div>
</article>
@endsection
