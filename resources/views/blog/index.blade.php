@extends('layouts.app')

@section('title', 'Blog | SEVO')
@section('description', 'SEO, GEO, and AEO insights from the SEVO team — search everywhere optimization tips and updates.')

@section('content')
<section class="border-b border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-900/50">
    <div class="mx-auto max-w-4xl px-4 py-16 text-center sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl dark:text-white">Blog</h1>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-slate-600 dark:text-slate-400">
            Search Everywhere Optimization insights — SEO, GEO, and AEO tips from the SEVO team.
        </p>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:px-8">
    @if ($posts->isEmpty())
        <p class="text-center text-slate-500 dark:text-slate-400">No posts yet — check back soon.</p>
    @else
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts as $post)
                <article class="flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    @if ($post->featured_image)
                        <a href="{{ route('blog.show', $post->slug) }}">
                            <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" class="h-48 w-full object-cover">
                        </a>
                    @endif
                    <div class="flex flex-1 flex-col p-6">
                        @if ($post->categories->isNotEmpty())
                            <div class="mb-2 flex flex-wrap gap-2">
                                @foreach ($post->categories as $category)
                                    <span class="rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-semibold text-blue-700 dark:bg-emerald-500/10 dark:text-emerald-400">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        @endif
                        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">
                            <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-blue-600 dark:hover:text-emerald-400">{{ $post->title }}</a>
                        </h2>
                        @if ($post->excerpt)
                            <p class="mt-2 flex-1 text-sm text-slate-600 dark:text-slate-400">{{ $post->excerpt }}</p>
                        @endif
                        <p class="mt-4 text-xs text-slate-400">{{ $post->published_at?->format('j M Y') }}</p>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    @endif
</section>
@endsection
