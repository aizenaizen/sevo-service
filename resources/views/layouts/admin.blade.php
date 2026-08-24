<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') — SEVO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">

    @if (session('admin_authenticated'))
        <header class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-6">
                    <a href="{{ route('admin.pages.index') }}" class="text-lg font-bold tracking-tight text-slate-900">SEVO Admin</a>
                    <nav class="flex items-center gap-5 text-sm font-medium text-slate-600">
                        <a href="{{ route('admin.pages.index') }}" class="hover:text-blue-600 {{ request()->routeIs('admin.pages.*') ? 'text-blue-600' : '' }}">Pages</a>
                        <a href="{{ route('admin.posts.index') }}" class="hover:text-blue-600 {{ request()->routeIs('admin.posts.*') ? 'text-blue-600' : '' }}">Blog posts</a>
                        <a href="{{ route('admin.categories.index') }}" class="hover:text-blue-600 {{ request()->routeIs('admin.categories.*') ? 'text-blue-600' : '' }}">Categories</a>
                    </nav>
                </div>
                <div class="flex items-center gap-4 text-sm">
                    <a href="{{ route('home') }}" class="text-slate-500 hover:text-blue-600" target="_blank">View site &rarr;</a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="rounded-lg border border-slate-300 px-3 py-1.5 font-medium text-slate-600 hover:bg-slate-100">Log out</button>
                    </form>
                </div>
            </div>
        </header>
    @endif

    <main class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
