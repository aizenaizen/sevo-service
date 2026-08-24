@extends('layouts.admin')

@section('title', 'Pages')

@section('content')
<div class="space-y-10">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Pages</h1>
        <p class="mt-1 text-sm text-slate-500">Edit the H1 and meta text for the site's core pages, or create your own pages.</p>
    </div>

    <livewire:admin.pages.system-pages />

    <livewire:admin.pages.custom-pages />
</div>
@endsection
